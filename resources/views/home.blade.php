<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- custom css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('scripts/css/app.css') }}">

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="cstm-background">

    {{-- navbar --}}
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <b><i class="bi bi-currency-dollar d-inline-block align-text-top"></i> Commission Calculator</b>
            </a>
        </div>
    </nav>

    {{-- main content --}}
    <main class="p-4">
        <div id="header" class="row mb-4">
            <div class="col">
                <p class="header-title mb-0">Dashboard</p>
                <p class="subheader mb-0">Let's Calculate your Commission!</p>
            </div>
        </div>

        <form class="row g-3 mb-4">
            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="form-floating shadow-none">
                    <select class="form-select shadow-none" id="employee_nor_marketing_nm" aria-label="Floating label select example">
                        @foreach ($marketing_array as $data)
                            <option value="{{ $data }}">{{ $data }}</option>
                        @endforeach
                    </select>
                    <label for="employee_nor_marketing_nm"><i class="bi bi-people"></i> Employee / Marketing</label>
                </div>
            </div>

            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="form-floating shadow-none">
                    <input type="date" class="form-control shadow-none" id="job_period" placeholder="" value="">
                    <label for="job_period"><i class="bi bi-calendar-week"></i> Job Period</label>
                </div>
            </div>

            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="form-floating shadow-none">
                    <input type="text" class="form-control shadow-none" id="job_amount" placeholder="" value="">
                    <label for="job_amount"><i class="bi bi-credit-card-2-front"></i> Amount (in Rupiah)</label>
                </div>
            </div>

            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="form-floating shadow-none">
                    <input type="text" class="form-control shadow-none" id="gross_profit" placeholder="" value="">
                    <label for="gross_profit"><i class="bi bi-credit-card-2-front"></i> Gross Profit (in Rupiah)</label>
                </div>
            </div>

            <div class="col-12 col-lg-3 col-md-4 col-sm-6 d-flex align-self-center">
                <button id="submit-commission-data" type="button" class="btn btn-primary shadow-none px-4"><i class="bi bi-calculator"></i> Submit</button>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <p class="subheader mb-0"><i class="bi bi-database-add"></i> Commission Calculated:</p>
                <p id="commission-result" class="commission-txt mb-0"><span id="commission-result-curr">Rp. </span> <span id="commission-result-number">0,000.00</span></p>
            </div>
        </div>

        {{-- charts --}}
        <div class="row mt-4">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <p class="subheader mb-0"><i class="bi bi-bar-chart-line"></i> Marketing Jobs Chart</p>
                <canvas id="line-chart1"></canvas>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <p class="subheader mb-0"><i class="bi bi-bar-chart-line"></i> Profit Chart</p>
                <canvas id="line-chart2"></canvas>
            </div>
        </div>
    </main>

    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Bootstrap 5 js --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    {{-- custom js --}}
    <script>

        const commission_amount = {{ $commission_rate }};

        $(document).ready(function(){
            // create chart
            create_chart()

            // masking string number to currency format
            $("#job_amount").keyup(function(){
                $('#job_amount, #gross_profit').mask('000,000,000', {reverse: true});
            });

            $("#gross_profit").keyup(function(){
                $('#gross_profit').mask('000,000,000', {reverse: true});
            });

            // calculate commission
            $("#submit-commission-data").click(function(){
                let job_amount = $("#job_amount").val();
                let gross_profit = $("#gross_profit").val();

                let commission = (parseFloat(gross_profit) * parseFloat(commission_amount));

                console.log(parseFloat(gross_profit));
                console.log(parseFloat(commission_amount));

                $("#commission-result-number").text(`${commission}`);
                $("#commission-result-number").mask('000,000,000', {reverse: true});

                Swal.fire({
                    icon: "success",
                    title: "Successfully Calculated Commission!",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        function create_chart() {
            new Chart(document.getElementById("line-chart1"), {
                type : 'line',
                data : {
                    labels : @json($marketing_array),
                    datasets : [
                            {
                                data : @json($marketing_job_count),
                                label : "Jobs",
                                borderColor : "#3cba9f",
                                fill : false
                            }]
                },
                options : {
                    responsive: true,
                    title : {
                        display : true,
                        text : 'Marketing Jobs Chart'
                    }
                }
            });

            new Chart(document.getElementById("line-chart2"), {
                type : 'line',
                data : {
                    labels : @json($gross_profit_period_array),
                    datasets : [
                            {
                                data : @json($gross_profit_job_array),
                                label : "Jobs",
                                borderColor : "#e43202",
                                fill : false
                            }]
                },
                options : {
                    responsive: true,
                    title : {
                        display : true,
                        text : 'Profit Chart'
                    }
                }
            });
        }
    </script>
</body>
</html>
