<?php ini_set('memory_limit', '-1'); ?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>TMS - Raw Material Forecast Note</title>

        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            .subheader{
                width: 50% !important;
            }

            .header{
                width: 100% !important;
                top: 0px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                text-align: center;

            }

            .authorize{
                width:25%;
            }

            .no-padding{
                padding: 2px 10px 2px 10px;
            }

            table, th, td{
                padding: 4px;
                border: 1px solid #111;
            }

            .align-right{
                text-align: right;
            }

            .align-center{
                text-align: center;
            }

            .table-font{
                font-size: 12px;
            }

            .title-container {
                width: 100%;
                text-align:center;
                font-size: 14px;
                line-height: 5px;
            }

            .no-border{
                border-left: 1px solid #fff;
                border-top: 1px solid #fff;
                border-bottom: 1px solid #fff;
                border-right: 1px solid #fff;
            }

            .no-border-2{
                border-top: 1px solid #fff;
                border-right: 1px solid #fff;
            }

            .no-border-3{
                border-left: 1px solid #fff;
                border-top: 1px solid #fff;
                border-bottom: 1px solid #fff;
            }

            .title {
                text-decoration: underline;
                font-weight: bold;
                text-align: center;
                font-size: 18px;
                border-left: 1px solid #fff;
                border-top: 1px solid #fff;
                border-bottom: 1px solid #fff;
            }

            .page {
        		overflow: hidden;
        		page-break-after: always;
    		}

        </style>
    </head>
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

                    <div class="page">
                        <div class="header">
                            <table class="table-font" style="padding-bottom: -5px">
                                <td width="80%" class="no-border"> </td>
                                <td width="20%" class="no-border" style="text-align:center">{{$parameter[0]->print_date}}</td>
                            </table>
                            <table class="table-font">
                            <tr>
                                <td width="80%" class="no-border-3"> </td>
                                <td width="10%" style="text-align:center">Approved by</td>
                                <td width="10%" style="text-align:center">Prepared by</td>
                            </tr>
                            <tr>
                                <td width="80%" class="title">{{$header[0]->company}}</td>
                                <td width="10%" style="text-align:center; border-bottom: 1px solid #fff;"></td>
                                <td width="10%" style="text-align:center; border-bottom: 1px solid #fff;"></td>
                            </tr>
                            <tr>
                                <td width="80%" class="title">PRODUCTION REQUIREMENT PLANNING</td>
                                <td width="10%" style="text-align:center">{{$ver_period[0]->approved_date}}</td>
                                <td width="10%" style="text-align:center">{{$ver_period[0]->prepared_date}}</td>
                            </tr>
                            <tr>
                                <td width="80%" class="no-border-3"> </td>
                                <td width="10%" style="text-align:center">{{$parameter[0]->approved_by}}</td>
                                <td width="10%" style="text-align:center">{{$parameter[0]->prepared_by}}</td>
                            </tr>
                            </table>
                            <table class="subheader table-font">
                                <tr>
                                <td class="no-padding" width="15%">Up.</td>
                                <td class="no-padding" width="85%">{{$header[0]->contact}}</td>
                                </tr>
                                <tr>
                                <td class="no-padding" width="15%">Telp.</td>
                                <td class="no-padding" width="85%">{{$header[0]->phone}}</td>
                                </tr>
                                <tr>
                                <td class="no-padding" width="15%">Fax</td>
                                <td class="no-padding" width="85%">{{$header[0]->fax}}</td>
                                </tr>
                            </table>
                            <table class="table-font" style="padding-bottom: -5px">
                                <td width="90%" class="no-border"> </td>
                                <td width="10%" class="no-border" style="text-align:center">{{$ver_period[0]->ver_no}}</td>
                            </table>
                        </div>


                        <div style="padding-top: 190px">
                            <table class="table-font">
                                <thead>
                                    <tr class="align-center">
                                        <th rowspan="3" width="2%">NO</th>
                                        <th rowspan="2" colspan="4">NAMA BARANG</th>
                                        <th rowspan="3">TYPE</th>
                                        <th rowspan="3" width="4%">UNIT</th>
                                        <th colspan="7">FORECAST (MONTH)</th>
                                    </tr>
                                    <tr class="align-center">
                                        <th>{{$ver_period[0]->m0}}</th>
                                        <th>{{$ver_period[0]->m1}}</th>
                                        <th>{{$ver_period[0]->m2}}</th>
                                        <th>{{$ver_period[0]->m3}}</th>
                                        <th>{{$ver_period[0]->m4}}</th>
                                        <th>{{$ver_period[0]->m5}}</th>
                                        <th>{{$ver_period[0]->m6}}</th>
                                    </tr>
                                    <tr class="align-center">
                                        <th>spec</th>
                                        <th width="5%">t</th>
                                        <th width="5%">l</th>
                                        <th width="5%">p</th>
                                        <th width="8%">{{$ver_period[0]->N0}}</th>
                                        <th width="8%">{{$ver_period[0]->N1}}</th>
                                        <th width="8%">{{$ver_period[0]->N2}}</th>
                                        <th width="8%">{{$ver_period[0]->N3}}</th>
                                        <th width="8%">{{$ver_period[0]->N4}}</th>
                                        <th width="8%">{{$ver_period[0]->N5}}</th>
                                        <th width="8%">{{$ver_period[0]->N6}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($chunk as $row)
                                        <tr>
                                            <td class='align-center'>{{$row->rownr}}</td>
                                            <td>{{$row->spec}}</td>
                                            <td class='align-right'>{{$row->t}}</td>
                                            <td class='align-right'>{{$row->l}}</td>
                                            <td class='align-right'>{{$row->p}}</td>
                                            <td class='align-center'>{{$row->model}}</td>
                                            <td class='align-center'>{{$row->unit}}</td>
                                            <td class='align-right'>{{$row->sc_tm_qty}}</td>
                                            <td class='align-right'>{{$row->sc_nm_1_qty}}</td>
                                            <td class='align-right'>{{$row->sc_nm_2_qty}}</td>
                                            <td class='align-right'>{{$row->sc_nm_3_qty}}</td>
                                            <td class='align-right'>{{$row->sc_nm_4_qty}}</td>
                                            <td class='align-right'>{{$row->sc_nm_5_qty}}</td>
                                            <td class='align-right'>{{$row->sc_nm_6_qty}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div>
                            <table class="table-font" style="padding-bottom: -5px">
                                <tr>
                                    <td width="90%" class="no-border" style="font-size: 12px; font-weight: bold; ">{{$parameter[0]->ld_number}}</td>
                                    <td width="10%" class="no-border" style="text-align:center">{{ $x." of ".$page }}</td>
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
