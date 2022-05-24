@extends('layout.layout')

@section('content-body')
    <script>
        $(document).ready(function() {

            $('.modal').modal();
        });
    </script>
    <div class="row">
        <div class="col l12 m12 s12">
            <a class="waves-effect waves-light btn-small modal-trigger" href="{{ url('web/state/index/'.$country_id.'') }}"><i
                class="material-icons left">arrow_back</i>Back</a>
        </div>
       
    </div>
    <div class="row">
        <div class="col l9 m9 s9">
            <h4>City</h4>
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
                <th>City Name</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($list as $key => $city)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $city->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- modal --}}
    <div id="modal1" class="modal">
        
        <div class="modal-content">
            <div class="row">
                <div class="col l12 m12 s12"><h4>City Form</h4></div>
            </div>
            <form action="{{ url('web/city/store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="stateInput" class="form-label">State Name</label>
                    <input type="text" name="name" class="form-control" id="stateInput" placeholder="Enter state name">
                    <input type="hidden" name="state_id" value="{{$state_id}}"/>
                    <input type="hidden" name="country_id" value="{{ $country_id }}"/>
                </div>

                <br /><br />
                <div class="mb-3">
                    <div class="row">
                        <div class="col"><button type="submit" class="btn btn-primary"
                                style="width: 100%;">Save</button>
                        </div>

                        <div class="col"><button type="reset" class="btn red modal-close"
                                style="width: 100%;">Cancel</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
