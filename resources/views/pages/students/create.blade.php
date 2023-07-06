@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding" style="background-color: rgb(233, 230, 230)">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header">
                    <h2>Add new Student</h2>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <div class="text-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('store.student') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="first_name">First name</label>
                                    <input type="text" id="first_name" class="form-control"
                                        placeholder="Enter First name" name="first_name" value="{{ old('first_name') }}"
                                        required>

                                    <div class="text-danger">
                                        @error('first_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" class="form-control" placeholder="Enter Last name"
                                        name="last_name" value="{{ old('last_name') }}" required>
                                    <div class="text-danger">
                                        @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="father_name">Father name</label>
                                    <input type="text" id="father_name" class="form-control"
                                        placeholder="Enter Father name" name="father_name" value="{{ old('father_name') }}">
                                    <div class="text-danger">
                                        @error('father_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="governorate">Governorate</label>
                                    <input type="text" id="governorate" class="form-control"
                                        placeholder="Enter governorate" name="governorate" value="{{ old('governorate') }}"
                                        required>
                                    <div class="text-danger">
                                        @error('governorate')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="Phone">Phone</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone Number"
                                        name="phone" value="{{ old('phone') }}" required>
                                    <div class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="parent_phone">Parent phone</label>
                                    <input type="text" id="parent_phone" class="form-control"
                                        placeholder="Enter parent phone" name="parent_phone"
                                        value="{{ old('parent_phone') }}" required>
                                    <div class="text-danger">
                                        @error('parent_phone')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- -------------- subjects --------------- --}}
                        @php
                            $subjectIds = old('subjects_ids' , []);
                        @endphp
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="subjects">subjects</label>
                                    <select multiple id='subjects' name="subjects_ids[]"
                                        class="form-control mt-2 ui search selection dropdown">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" @selected(in_array($subject->id, $subjectIds))>{{ $subject->package->name }} -
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('subjects')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="amount">amount</label>
                                    <input type="number" class="form-control" placeholder="Enter amount" name="amount"
                                        id="amount" value="{{ old('amount') }}" required>
                                    <div class="text-danger">
                                        @error('amount')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="land_line">Land line</label>
                                    <input type="text" id="land_line" class="form-control"
                                        placeholder="Enter land line number" name="land_line"
                                        value="{{ old('land_line') }}" required>
                                    <div class="text-danger">
                                        @error('land_line')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="bill_number">bill_number</label>
                                    <input type="text" id="bill_number" class="form-control"
                                        placeholder="Enter bill Number" name="bill_number"
                                        value="{{ old('bill_number') }}" required>
                                    <div class="text-danger">
                                        @error('bill_number')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="payment_method">payment method</label>
                                    <select name="payment_method_id" id="payment_method" class="form-control">
                                        <option hidden>Enter PaymentMethod</option>
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}" @selected($paymentMethod->id == old('payment_method_id'))>
                                                {{ $paymentMethod->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('payment_method_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn white m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ############ PAGE END-->
        <script>
            $('.ui.dropdown').dropdown();
            //reload selected img
            $(document).ready(() => {
                $('#cover').change(function() {
                    const file = this.files[0];
                    console.log(file);
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            console.log(event.target.result);
                            $('#imgPreview').attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    @endsection
