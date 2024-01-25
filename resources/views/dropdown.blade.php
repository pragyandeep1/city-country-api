<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Building City and Country</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-primary mb-4 text-center">
                   <h4>Building City and Country</h4>
                </div> 
                <form>
                    <div class="form-group mb-3">
                        <select id="country-dropdown" class="form-control">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $data)
                                <option value="{{$data->id}}">
                                    {{$data->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select id="state-dropdown" class="form-control"></select>
                    </div>
                    <div class="form-group mb-3">
                        <select id="city-dropdown" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <select id="population-display" class="form-control"></select>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

        /* Country Dropdown Change Event */
        $('#country-dropdown').on('change', function () {
            var idCountry = this.value;
            $("#state-dropdown, #city-dropdown, #population-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown').html('<option value="">-- Select State --</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    $('#population-dropdown').html('<option value="">-- Show Population --</option>');
                }
            });
        });

        /* State Dropdown Change Event */
        $('#state-dropdown').on('change', function () {
            var idState = this.value;
            $("#city-dropdown, #population-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#population-dropdown').html('<option value="">-- Show Population --</option>');
                }
            });
        });

        /* City Dropdown Change Event */
        $('#city-dropdown').on('change', function () {
            var idCity = this.value;
            $("#population-display").html('');
            $.ajax({
                url: "{{url('api/fetch-population')}}",
                type: "POST",
                data: {
                    city_id: idCity,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#population-display').html('<option value="' + res.population.id + '"> 150000 </option>'+'<option value="' + res.population.id + '"> 80000 </option>');
                }
            });
        });
    });
    </script>
</body>
</html>
