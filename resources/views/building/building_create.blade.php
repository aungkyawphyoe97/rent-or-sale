@extends('layout.layout')

@section('content-body')
    <style>
        .card-content {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        .card-content>div>span {
            font-weight: 800;
            font-size: 1.5rem;
        }

        .card-content>div {
            margin-bottom: 8px;
        }

        .currency {
            font-weight: 700 !important;
            text-align: center;
            background: #808080 !important;
            color: white !important;
            padding-left: 0px !important;
        }

    </style>
    <script>
        $(document).ready(function() {
            let tab = document.querySelector(".tab");
            let tabHeader = tab.querySelector(".tab-header");
            let tabIndicator = tab.querySelector(".tab-indicator");
            let tabHeaderNodes = tab.querySelectorAll(".tab-header > div");
            let houseArea = document.querySelector(".house-area");
            let buildingArea = document.querySelector(".building-area");
            let floor = document.querySelector(".floor");
            let garage = document.querySelector(".garage");
            let elevator = document.querySelector(".elevator");


            for (let i = 0; i < tabHeaderNodes.length; i++) {
                tabHeaderNodes[i].addEventListener("click", function() {
                    tabHeader.querySelector(".active").classList.remove("active");
                    tabHeaderNodes[i].classList.add("active");

                    if (i == 0) {
                        tabIndicator.style.left = `calc(calc(calc(50% - 5px) * ${i}) + 7px)`;
                        houseArea.classList.remove("hide");
                        buildingArea.classList.add("hide");
                        floor.classList.add("hide");
                        garage.classList.remove("hide");
                        elevator.classList.add("hide");
                        $('.buildingType').val(0);
                    }
                    if (i == 1) {
                        houseArea.classList.add("hide");
                        buildingArea.classList.remove("hide");
                        floor.classList.remove("hide");
                        garage.classList.add("hide");
                        tabIndicator.style.left = `calc(calc(calc(50% - 2px) * ${i}))`;
                        elevator.classList.remove("hide");
                        $('.buildingType').val(1);
                    }
                });
            }

            //rent or sale
            let rentPrice = document.querySelector('.rentPrice');
            let salePrice = document.querySelector('.salePrice');

            $('input[type=radio][name=rentOrSale]').change(function() {

                if (this.value == '0') {
                    rentPrice.classList.remove('hide');
                    salePrice.classList.add('hide');
                    $('.contractOption').attr("placeholder", "e.g : Rent minimum 3 month");
                } else if (this.value == '1') {
                    rentPrice.classList.add('hide');
                    salePrice.classList.remove('hide');
                    $('.contractOption').attr("placeholder", "e.g : Installment payment or Full Payment");
                }
            });

            $(".hall").change(function() {
                if (this.checked) {
                    document.querySelector(".livingroom").classList.add("hide");
                    document.querySelector(".bedroom").classList.add("hide");
                    document.querySelector(".bathroom").classList.add("hide");
                    document.querySelector(".kitchen").classList.add("hide");
                    document.querySelector(".garage").classList.add("hide");

                } else {
                    document.querySelector(".livingroom").classList.remove("hide");
                    document.querySelector(".bedroom").classList.remove("hide");
                    document.querySelector(".bathroom").classList.remove("hide");
                    document.querySelector(".kitchen").classList.remove("hide");
                    document.querySelector(".garage").classList.remove("hide");
                }
            });



        });

        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: -25.344,
                lng: 131.031
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }

        window.initMap = initMap;
    </script>
    <form action="{{ url('web/building/store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="tab">
                    <div class="tab-header">
                        <div class="active">House</div>
                        <div>Apartment</div>
                    </div>
                    <div class="tab-indicator"></div>
                </div>
            </div>
        </div>
        <br><br><br>
        <input name="buildingType" value="0" type="hidden" class="input-box buildingType">
        {{-- facilities --}}
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <div><span>Rooms and Facilities</span></div>
                        <br>
                        <div class="row">
                            <div class="col l4 m4 s6">
                                <label>
                                    <input name="hall" @if (old('hall')) checked @endif type="checkbox"
                                        class="filled-in hall" />
                                    <span>Hall</span>
                                </label>
                            </div>
                            <div class="col l4 m4 s6 livingroom">
                                <label>
                                    <input name="livingroom" @if (old('livingroom')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Livingroom</span>
                                </label>
                            </div>
                            <div class="col l4 m4 s6 bathroom">
                                <label><input name="bathroom" @if (old('bathroom')) checked @endif
                                        type="checkbox" class="filled-in " />
                                    <span>Bathroom</span></label>
                            </div>
                            <div class="col l4 m4 s6 bedroom">
                                <label><input name="bedroom" @if (old('bedroom')) checked @endif
                                        type="checkbox" class="filled-in " />
                                    <span>BedRoom</span></label>
                            </div>

                            <div class="col l4 m4 s6">
                                <label><input name="funiture" @if (old('funiture')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Funiture</span> </label>
                            </div>
                            <div class="col l4 m4 s6">
                                <label><input name="aircon" @if (old('aircon')) checked @endif type="checkbox"
                                        class="filled-in" />
                                    <span>Aircon</span></label>
                            </div>
                            <div class="col l4 m4 s6">
                                <label><input name="refrigerator" @if (old('refrigerator')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Refrigerator</span></label>
                            </div>
                            <div class="col l4 m4 s6">
                                <label><input name="water" @if (old('water')) checked @endif type="checkbox"
                                        class="filled-in" />
                                    <span>Water</span></label>
                            </div>
                            <div class="col l4 m4 s4">
                                <label><input name="electricity" @if (old('electricity')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Electricity</span></label>
                            </div>
                            <div class="col l4 m4 s6 kitchen">
                                <label><input name="kitchen" @if (old('kitchen')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Kitchen</span></label>
                            </div>
                            <div class="col l4 m4 s6 elevator hide">
                                <label><input name="elevator" @if (old('elevator')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Elevator</span></label>
                            </div>
                            <div class="col l4 m4 s6">
                                <label><input name="parking" @if (old('parking')) checked @endif
                                        type="checkbox" class="filled-in" />
                                    <span>Parking</span></label>
                            </div>
                            <div class="col l4 m4 s6 garage">
                                <label><input name="garage" @if (old('garage')) checked @endif
                                        type="checkbox" class="filled-in garage" />
                                    <span>Garage</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- area of property --}}
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <div class="house-area"><span>Area of House</span></div>
                        <div class="building-area hide"><span>Area of Apartment</span></div>
                        <div class="row">
                            <div class="col l4 m4 s8">
                                <div class="input-box-label">
                                    <label>Measurement</label>
                                </div>
                                <select class="select-state select-box" name="measurement">
                                    @foreach ($measurementList as $key => $measurement)
                                        <option value="{{ $measurement->length_measurement_id }}">
                                            {{ $measurement->name }}
                                            ({{ $measurement->symbol }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l4 m4 s6">
                                <div class="input-box-label">
                                    <label>Length <span class="red-text">*</span>

                                    </label>
                                </div>
                                <input name="length" value="{{ old('length') }}" type="number" class="input-box"
                                    placeholder="e.g : 10">
                                @if ($errors->has('length'))
                                    <label> <span class="red-text">{{ $errors->first('length') }}</span></label>
                                @endif
                            </div>
                            <div class="col l4 m4 s6">
                                <div class="input-box-label">
                                    <label>Width <span class="red-text">*</span></label>
                                </div>
                                <input name="width" value="{{ old('width') }}" type="number" class="input-box"
                                    placeholder="e.g : 10">
                                @if ($errors->has('width'))
                                    <label> <span class="red-text">{{ $errors->first('width') }}</span></label>
                                @endif
                            </div>
                            <div class="col l4 m4 s6">
                                <div class="input-box-label">
                                    <label>Height <span class="red-text">*</span></label>
                                </div>
                                <input name="height" value="{{ old('height') }}" type="number" class="input-box"
                                    placeholder="e.g : 10">
                                @if ($errors->has('height'))
                                    <label> <span class="red-text">{{ $errors->first('height') }}</span></label>
                                @endif
                            </div>
                        </div>
                        <div class="row floor hide">
                            <div class="col l12 m12 s12">
                                <div class="input-box-label">
                                    <label>Floor <span class="red-text">*</span></label>
                                </div>
                                <input name="floor" type="number" class="input-box " placeholder="e.g : 5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Location --}}
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <div><span>Location</span></div>
                        <div class="row">
                            <div class="col l4 m4 s12">
                                <div class="input-box-label">
                                    <label>Country</label>
                                </div>
                                <select class="select-country select-box">
                                    @foreach ($countryList as $key => $country)
                                        <option value="{{ $country->country_id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col l4 m4 s12">
                                <div class="input-box-label">
                                    <label>State</label>
                                </div>
                                <select class="select-state select-box">
                                    @foreach ($stateList as $key => $state)
                                        <option value="{{ $state->state_id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col l4 m4 s12">
                                <div class="input-box-label">
                                    <label>City</label>
                                </div>
                                <select class="select-box select-city" name="city">
                                    @foreach ($cityList as $key => $city)
                                        <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col l12 m12 s12" style="padding-right: 0px">
                                <div class="input-box-label">
                                    <label>Address <span class="red-text">*</span></label>
                                </div>
                                <textarea name="address" value="{{ old('address') }}" id="textarea1" class="materialize-textarea input-box"
                                    style="height: 100px !important"
                                    placeholder="House or Apartment address"></textarea>
                                @if ($errors->has('address'))
                                    <label> <span class="red-text">{{ $errors->first('address') }}</span></label>
                                @endif
                            </div>

                            <div class="col l12 m12 s12">
                                <div class="input-box-label">
                                    <label>Google Address ( Optional )</label>
                                </div>
                                <input name="googleAddress" type="text" class="input-box"
                                    placeholder="Paste here the google map address ... (e.g) 1.3767189612356658, 103.8511416911658">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sale or Rent --}}

        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <div> <span>Rent Or Sale</span></div>
                        <br>
                        <div class="row">
                            <div class="col l2 m2 s6">
                                <label>
                                    <input name="rentOrSale" class="with-gap" type="radio" value="0"
                                        @if (!old('rentOrSale')) checked @endif />
                                    <span>Rent</span>
                                </label>
                            </div>
                            <div class="col l2 m2 s6">
                                <label>
                                    <input name="rentOrSale" class="with-gap" type="radio" value="1"
                                        @if (old('rentOrSale')) checked @endif />
                                    <span>Sale</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l10 m10 s9">
                                <div class="input-box-label rentPrice">
                                    <label>Rental Price <span class="red-text">*</span> ( per month )</label>
                                </div>
                                <div class="input-box-label salePrice hide">
                                    <label>Sale Price <span class="red-text">*</span></label>
                                </div>
                                <input name="price" value="{{ old('price') }}" id="price" type="number"
                                    class="input-box" placeholder="e.g : 100000">
                                @if ($errors->has('price'))
                                    <label> <span class="red-text">{{ $errors->first('price') }}</span></label>
                                @endif
                            </div>
                            <div class="col l2 m2 s3">
                                <div class="input-box-label">
                                    <label>Currency</label>
                                </div>
                                <input id="currency" type="text" class="input-box currency"
                                    value="{{ $firstCountry->symbol }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l12 m12 s12">
                                <div class="input-box-label">
                                    <label>Contract Option<span class="red-text">*</span></label>
                                </div>
                                <input name="contractOption" value="{{ old('contractOption') }}" id="contractOption"
                                    type="text" class="input-box contractOption" placeholder="e.g : Rent minimum 3 month">
                                @if ($errors->has('price'))
                                    <label> <span class="red-text">{{ $errors->first('price') }}</span></label>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Owner Info --}}
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <div><span>Owner Info</span></div>
                        <div class="row">
                            <div class="col l12 m12 s12">
                                <div class="input-box-label">
                                    <label>Owner Name <span class="red-text">*</span></label>
                                </div>
                                <input name="ownerName" value="{{ old('ownerName') }}" type="text"
                                    class="input-box" placeholder="e.g. U Aung Aung">
                                @if ($errors->has('ownerName'))
                                    <label> <span
                                            class="red-text">{{ $errors->first('ownerName') }}</span></label>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col l6 m6 s12">
                                <div class="input-box-label">
                                    <label>Phone Nubmer ( 1 ) <span class="red-text">*</span></label>
                                </div>
                                <input name="phone1" value="{{ old('phone1') }}" type="text" class="input-box"
                                    placeholder="e.g : 09xxxxxxxxx">

                                @if ($errors->has('phone1'))
                                    <label> <span class="red-text">{{ $errors->first('phone1') }}</span> </label>
                                @endif

                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-box-label">
                                    <label>Phone Number ( 2 )</label>
                                </div>
                                <input name="phone2" type="text" class="input-box" placeholder="e.g : 09xxxxxxxxx">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <div><span>Photos</span></div>
                        <div class="row">
                            <img class="materialboxed" width="200"
                                src="https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?cs=srgb&dl=pexels-vecislavas-popa-1571460.jpg&fm=jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col l6 m6 s6"></div>
            <div class="col l6 m6 s6 right">
                <button class="waves-effect waves-light btn">Back</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="waves-effect waves-light btn">Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col l12 m12 s12">
                <label>Choose Images</label>
                <input type="file" name="image">
            </div>
        </div>

    </form>
    {{-- <div class="row">
        <div class="col l12 m12 s12">
            <div class="card">
                <div class="card-content">
                    <div><span></span></div>
                    
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col l12 m12 s12">
            <div class="card">
                <div class="card-content">
                    <div><span></span></div>
                    <div class="row"></div>
                </div>
            </div>
        </div>
    </div> --}}





    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d82762.66256397904!2d103.75377490931065!3d1.373946867323925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ssg!4v1651674276997!5m2!1sen!2ssg" 
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

    <div id="map"></div>

    <!--
                                                                                                                                                                                                                                             The `defer` attribute causes the callback to execute after the full HTML
                                                                                                                                                                                                                                             document has been parsed. For non-blocking uses, avoiding race conditions,
                                                                                                                                                                                                                                             and consistent behavior across browsers, consider loading using Promises
                                                                                                                                                                                                                                             with https://www.npmjs.com/package/@googlemaps/js-api-loader.
                                                                                                                                                                                                                                            -->
    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
        defer></script> --}}

    <script>
        $('.select-country').change(function(e) {
            const countryId = $('.select-country').val();
            var state = $('.select-state');
            var isFirst = true;
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/web/building/state') }}" + "/" + countryId,
                method: 'get',
                success: function(data) {
                    state.empty();
                    if (data != null && data.stateList != null && data.stateList
                        .length != 0) {
                        $
                            .each(
                                data.stateList,
                                function(i, item) {
                                    state
                                        .append(
                                            $(
                                                '<option>', {
                                                    value: item.state_id,
                                                    text: item.name
                                                }));

                                    if (isFirst) {
                                        $(".id").val(item.state_id);
                                        $(".name").val(item.name);
                                        isFirst = false;

                                        const stateId = item.state_id;
                                        var city = $('.select-city');

                                        e.preventDefault();
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="_token"]').attr(
                                                    'content')
                                            }
                                        });
                                        $.ajax({
                                            url: "{{ url('/web/building/city') }}" +
                                                "/" + stateId,
                                            method: 'get',
                                            success: function(data) {
                                                city.empty();
                                                if (data != null && data
                                                    .cityList != null && data
                                                    .cityList
                                                    .length != 0) {
                                                    $
                                                        .each(
                                                            data.cityList,
                                                            function(i, item) {
                                                                city
                                                                    .append(
                                                                        $(
                                                                            '<option>', {
                                                                                value: item
                                                                                    .city_id,
                                                                                text: item
                                                                                    .name
                                                                            }));
                                                            });
                                                }
                                            }
                                        });

                                    }
                                });
                    }
                }
            });
        });

        $('.select-state').change(function(e) {
            const stateId = $('.select-state').val();
            var city = $('.select-city');
            var isFirst = true;
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/web/building/city') }}" + "/" + stateId,
                method: 'get',

                success: function(data) {
                    city.empty();
                    if (data != null && data.cityList != null && data.cityList
                        .length != 0) {
                        $
                            .each(
                                data.cityList,
                                function(i, item) {
                                    city
                                        .append(
                                            $(
                                                '<option>', {
                                                    value: item.city_id,
                                                    text: item.name
                                                }));
                                    if (isFirst) {
                                        $(".id").val(item.city_id);
                                        $(".name").val(item.name);
                                        isFirst = false;
                                    }
                                });
                    }
                }
            });
        });
        $('.select-country').change(function(e) {
            const countryId = $('.select-country').val();
            var state = $('.select-state');
            var isFirst = true;
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/web/building/state') }}" + "/" + countryId,
                method: 'get',
                success: function(data) {
                    state.empty();
                    if (data != null && data.stateList != null && data.stateList
                        .length != 0) {
                        $
                            .each(
                                data.stateList,
                                function(i, item) {
                                    state
                                        .append(
                                            $(
                                                '<option>', {
                                                    value: item.state_id,
                                                    text: item.name
                                                }));

                                    if (isFirst) {
                                        $(".id").val(item.state_id);
                                        $(".name").val(item.name);
                                        isFirst = false;

                                        const stateId = item.state_id;
                                        var city = $('.select-city');

                                        e.preventDefault();
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="_token"]').attr(
                                                    'content')
                                            }
                                        });
                                        $.ajax({
                                            url: "{{ url('/web/building/city') }}" +
                                                "/" + stateId,
                                            method: 'get',
                                            success: function(data) {
                                                city.empty();
                                                if (data != null && data
                                                    .cityList != null && data
                                                    .cityList
                                                    .length != 0) {
                                                    $
                                                        .each(
                                                            data.cityList,
                                                            function(i, item) {
                                                                city
                                                                    .append(
                                                                        $(
                                                                            '<option>', {
                                                                                value: item
                                                                                    .city_id,
                                                                                text: item
                                                                                    .name
                                                                            }));
                                                            });
                                                }
                                            }
                                        });

                                    }
                                });
                    }
                }
            });
        });

        $('.select-state').change(function(e) {
            const stateId = $('.select-state').val();
            var city = $('.select-city');
            var isFirst = true;
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/web/building/city') }}" + "/" + stateId,
                method: 'get',

                success: function(data) {
                    city.empty();
                    if (data != null && data.cityList != null && data.cityList
                        .length != 0) {
                        $
                            .each(
                                data.cityList,
                                function(i, item) {
                                    city
                                        .append(
                                            $(
                                                '<option>', {
                                                    value: item.city_id,
                                                    text: item.name
                                                }));
                                    if (isFirst) {
                                        $(".id").val(item.city_id);
                                        $(".name").val(item.name);
                                        isFirst = false;
                                    }
                                });
                    }
                }
            });
        });
    </script>
@endsection
