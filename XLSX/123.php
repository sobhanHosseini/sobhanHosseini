<?php
trait KeuanganExportTrait
{
	use ResponseTrait;

	private $requestId;

	/**
	 * generate header column
	 * @param $id
	 * @param bool $showName
	 * @param bool $includeDefaultColumn
	 * @return array
	 */
	public function generateHeadings($id, $showName = true, $includeDefaultColumn = true): array
	{
		$this->requestId = $id;
		$rekeningHeader = Apiato::call('KeuRekening@SearchKeuRekeningByIdTask', [$id]);
		$rekeningHeader = collect($rekeningHeader)->reduce(function ($result, $value) use ($showName) {
			if ($showName) {
				$result["_" . $value['id']] = $value['nama'];
				return $result;
			}

			$result["_" . $value['id']] = null;
			return $result;

		}, collect([]));

		if ($includeDefaultColumn) {
			$rekeningHeader->prepend('Nama', 'Nama');
			$rekeningHeader->prepend('Nis/Nisn', 'Nis/Nisn');
			$rekeningHeader->prepend('No', 'No');
			$rekeningHeader->put('Total', 'Total');
		}

		return $rekeningHeader->toArray();

	}

	/**
	 * mapping data keuangan transaksi
	 * @param $siasRombel
	 * @return Collection
	 */
	public function generateCollection($siasRombel, $piutang = false)
	{
		$nomor = 0;
		$pesertaDidik = [];

		$siasRombel = Apiato::call('SiasRombel@FindSiasRombelByIdTask', [$siasRombel['id']]);
		$siasRombel = $this->transform($siasRombel, SiasRombelTransformer::class, ['siasPesertaDidikRombel.siasPesertaDidik.keuTransaksi']);

		if (array_key_exists('siasPesertaDidikRombel', $siasRombel['data'])
			&& sizeof($siasRombel['data']['siasPesertaDidikRombel']['data']) > 0) {

			$results['No'] = $nomor;
			$results['Total'] = 0;
			$pesertaDidik = collect($siasRombel['data']['siasPesertaDidikRombel']['data'])->map(function ($pd) use ($results, &$nomor, $piutang) {

				$nomor++;
				$results['No'] = $nomor;
				$results['Nama'] = $pd['siasPesertaDidik']['data']['nama'];
				$results['Nis/Nisn'] = $pd['siasPesertaDidik']['data']['nisn'];

				$transaksi = [];
				if (array_key_exists('keuTransaksi', $pd['siasPesertaDidik']['data'])
					&& sizeof($pd['siasPesertaDidik']['data']['keuTransaksi']['data']) > 0) {

					$trx['Total'] = 0;
					$transaksi = collect($pd['siasPesertaDidik']['data']['keuTransaksi']['data'])->flatMap(function ($transaksi) use (&$trx, $piutang) {
						if ($piutang) {
							$jml_piutang = (int)$transaksi['sum_total'] - (int)$transaksi['sum_terbayar'];
							$trx["_" . $transaksi['rekening_id']] = $jml_piutang;
							$trx['Total'] += $jml_piutang;
							return $trx;
						}

						$trx["_" . $transaksi['rekening_id']] = (int)$transaksi['sum_terbayar'];
						$trx['Total'] += $transaksi['sum_terbayar'];
						return $trx;

					})->toArray();
				}

				$results = array_merge($results, $transaksi);
				return $results;
			});
		}

		$siasRombel = collect($pesertaDidik);
		$siasRombel->push($this->sumByRekeningId($siasRombel));
		return $siasRombel;
	}

	/**
	 * sum value by rekening id
	 * @param Collection $data
	 * @return mixed
	 */
	private function sumByRekeningId(Collection $data)
	{
		$headerColumn = $this->generateHeadings($this->requestId, false, false);

		$result['No'] = null;
		$result['Nis/Nisn'] = null;
		$result['Nama'] = 'Total';
		$result['Total'] = 0;

		foreach ($headerColumn as $key => $value) {
			$result[$key] = $data->sum($key);
			$result['Total'] += $result[$key];
		}

		return $result;
	}