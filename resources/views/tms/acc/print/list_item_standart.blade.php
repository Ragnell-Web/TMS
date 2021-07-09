<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      .cons1{
        display: flex;
        justify-content: flex-end;
      }
      @media print{
        .noPrint{
          display: none;
        }
      }
    </style>
    <title>Print Web</title>
  </head>
  <body>
    <div class="container cons1 noPrint">
      <div class="row mt-3 ">
        <div class="col">
          <button class="btn btn-primary btn-round" id="downloadBtn">Download</button>
        </div>
      </div>
    </div>
    <div class="container mustToDownload" id="aidi">
      <div class="row mt-5">
        <div class="col-4">
          <p class="dateNow"></p>
        </div>
        <div class="col-4"><h5>PT TRIMITRA CHITRAHASTA <br><span class="textTitle">{{$reportTitle}}</span></h5>
        </div>
        <div class="col-4 cons1"><p>page 1</p></div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <table class="table table-stripped table-bordered text-center">
            <thead>
              <tr>
                <th width="40%">Item Id / Name</th>
                <th width="20%">Type</th>
                <th width="20%">Qty</th>
                <th width="20%">Value</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/JDMcKinstry/JavaScriptDateFormat/master/Date.format.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/print/scriptListItemStandart.js') }}"></script>

  </body>
</html>