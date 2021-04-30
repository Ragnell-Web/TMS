<html>
    <body>
        @php ($limit = 12)

        @foreach($detail_model as $d)
            @if(!empty($detail['data'.$d->model]))

                @php ($x = 1)
                @php ($n = 1)

                @foreach(array_chunk($detail['data'.$d->model], $limit, TRUE) AS $chunk)

                    @php ($page = 0)
                    @php (${'page'.$d->model} = $detail['data'.$d->model])

                    @foreach(array_chunk(${'page'.$d->model}, $limit, TRUE) AS $pageChunk)
						@php ($page = $page + 1)
					@endforeach

                    <div>
                        <div>
                            <table>
                                <td colspan="10"> </td>
                                <td colspan="4" style="text-align:center">{{$parameter[0]->print_date}}</td>
                            </table>
                            <table>
                                <tr>
                                    <td colspan="10"> </td>
                                    <td colspan="2" style="text-align:center; ">Approved by</td>
                                    <td colspan="2" style="text-align:center; ">Prepared by</td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:center">{{$header[0]->company}}</td>
                                    <td colspan="2" rowspan="2" style="text-align:center; ">{{$ver_period[0]->approved_date}}</td>
                                    <td colspan="2" rowspan="2" style="text-align:center; ">{{$ver_period[0]->prepared_date}}</td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:center">PRODUCTION REQUIREMENT PLANNING</td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:center"> </td>
                                    <td colspan="2" style="text-align:center; ">{{$parameter[0]->approved_by}}</td>
                                    <td colspan="2" style="text-align:center; ">{{$parameter[0]->prepared_by}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" >   Up.</td>
                                    <td colspan="6" style="text-align:left; ">{{$header[0]->contact}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" >   Telp.</td>
                                    <td colspan="6" style="text-align:left; ">{{$header[0]->phone}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">   Fax</td>
                                    <td colspan="6" style="text-align:left; ">{{$header[0]->fax}}</td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="text-align:center"> </td>
                                    <td colspan="2" style="text-align:center;">{{$ver_period[0]->ver_no}}</td>
                                </tr>

                                <thead>
                                    <tr>
                                        <th rowspan="3" style="text-align:center; ">NO</th>
                                        <th rowspan="2" colspan="4" style="text-align:center; ">NAMA BARANG</th>
                                        <th rowspan="3" style="text-align:center; ">TYPE</th>
                                        <th rowspan="3" style="text-align:center; ">UNIT</th>
                                        <th colspan="7" style="text-align:center; ">FORECAST (MONTH)</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center; ">{{$ver_period[0]->m0}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->m1}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->m2}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->m3}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->m4}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->m5}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->m6}}</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center; ">spec</th>
                                        <th style="text-align:center; ">t</th>
                                        <th style="text-align:center; ">l</th>
                                        <th style="text-align:center; ">p</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N0}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N1}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N2}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N3}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N4}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N5}}</th>
                                        <th style="text-align:center; ">{{$ver_period[0]->N6}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($chunk as $row)
                                        <tr>
                                            <td style="text-align:center; border: 1px solid black;">{{$row->rownr}}</td>
                                            <td style="text-align:left; border: 1px solid black;">{{$row->spec}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->t}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->l}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->p}}</td>
                                            <td style="text-align:center; border: 1px solid black;">{{$row->model}}</td>
                                            <td style="text-align:center; border: 1px solid black;">{{$row->unit}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_tm_qty}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_nm_1_qty}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_nm_2_qty}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_nm_3_qty}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_nm_4_qty}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_nm_5_qty}}</td>
                                            <td style="text-align:right; border: 1px solid black;">{{$row->sc_nm_6_qty}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <table>
                                <tr>
                                    <td colspan="12" style="text-align:left">{{$parameter[0]->ld_number}}</td>
                                    <td colspan="2" style="text-align:center">{{ $x." of ".$page }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @php ($x = $x+1)
                @endforeach
            @endif
        @endforeach
    </body>
</html>
