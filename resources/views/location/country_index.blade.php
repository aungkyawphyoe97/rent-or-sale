@extends('layout.layout')

@section('content-body')
    <script>
        $(document).ready(function() {

            $('.modal').modal();
        });
    </script>

    <div class="row">
        <div class="col l9 m9 s9">
            <h4>Country</h4>
        </div>
        <div class="col l3 m3 s3">
            <a class="waves-effect waves-light btn-small modal-trigger" href="#modal1"><i
                    class="material-icons left">add</i>New</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Country Name</th>
                <th>Currency Code</th>
                <th>Symbol</th>
                <th>Option</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($list as $key => $country)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->currency_code }}</td>
                    <td>{{ $country->symbol }}</td>
                    <th><a href="{{ url('web/state/index/'.$country->country_id.'') }}">State List</a></th>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- modal --}}
    <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="col l12 m12 s12"><h4>Country Form</h4></div>
            </div>
            <form action="store" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="countryInput" class="form-label">Country Name</label>
                    <input type="text" name="name" class="form-control" id="countryInput"
                        placeholder="Enter country name">
                </div>

                <div class="mb-3">
                    <label for="currencyInput" class="form-label">Currency Code</label>
                    <input type="text" name="currency_code" class="form-control" id="currencyInput"
                        placeholder="Enter Currency">
                </div>

                <div class="mb-3">
                    <label for="symbolInput" class="form-label">Symbol</label>
                    <input type="text" name="symbol" class="form-control" id="symbolInput"
                        placeholder="Enter Symbol">
                </div>

                <br /><br />
                <div class="mb-3">
                    <div class="row">
                        <div class="col"><button type="submit" class="btn btn-primary"
                                style="width: 100%;">Save</button>
                        </div>

                        <div class="col"><button type="reset" class="btn red"
                                style="width: 100%;">Cancel</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
