@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding" >
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header">
                    <h2 class="text-primary text-2x">Add new Student</h2>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">

                    {{-- template --}}
                    <div id="template-subject" class="d-none">                                                
                        <div class="alert alert-success p-1 d-inline">
                            <button type="button" class="btn btn-sm bg-transparent" onclick="delete_subject(this)"> <i
                                    class="fas fa-close"></i> </button>
                            <input type="hidden" name="amount" value="50">
                            <input type="hidden" name="subjects_ids[]" value="">
                            <span class="d-inline"></span>
                        </div>
                    </div>    
                    {{-- end of template --}}

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
                            
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="packages">packages</label>
                                    <select id='packages' onchange="filter(this, 'subjects')"
                                        class="form-control mt-2 ui search selection dropdown">
                                        <option value="" selected hidden>--select packages</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}" >
                                                {{ $package->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="subjects">subjects</label>
                                    <select id='subjects' onchange="addSubject(this)"
                                        class="form-control mt-2 ui search selection dropdown">
                                        <option value="" selected hidden> -- add subjects </option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" data-fk="{{ $subject->package_id }}" data-info="{{ $subject->package->name }} - {{ $subject->name }}" data-cost={{ $subject->cost }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('subjects_ids')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group- my-2">
                                <div class="row">
                                    {{-- template --}}
                                    <div id="subject-names" class="col">
                                        <div class="row">
                                                                                   
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-secondary py-2">
                                        <label for="sum-subject">sum of subject</label>
                                    </div>
                                    <div class="col-md-3"><input id="sum-subject" type="text"  value=0
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{-- end of subjects --}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="amount">amount</label>
                                        <input type="number" class="form-control" placeholder="Enter amount"
                                            name="amount" id="amount" value="{{ old('amount') }}" required>
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
                            <button type="submit" class="btn primary m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ############ PAGE END-->
        <script>
            function filter(parentList, filteredList) {
                filteredList = document.getElementById(filteredList)
                filteredList.options[0].selected = true
                for (option of filteredList.options) {
                    if (option.getAttribute('data-fk') != parentList.value)
                        option.hidden = true
                    else
                        option.hidden = false
                }
            }

            function doAddSubject(subjectId , subjectCost , label) {
                let template = document.getElementById("template-subject").children[0]
                let newSubject = template.cloneNode(true)
                newSubject.children[1].value= subjectCost 
                newSubject.children[2].value= subjectId
                newSubject.children[3].innerHTML= label
                document.querySelector("#subject-names .row").appendChild(newSubject)
                document.getElementById("sum-subject").value = Number( document.getElementById("sum-subject").value) + Number( subjectCost)                
            }
            
            function addSubject(inp) {
                let selectedOption = inp.options[inp.selectedIndex]
                let subjectId = selectedOption.value 
                let subjectCost = selectedOption.getAttribute('data-Cost')
                let label = selectedOption.getAttribute('data-info')
                doAddSubject(subjectId , subjectCost , label)                
            }

            function delete_subject(inp) {
                subjectCost = inp.nextElementSibling.value
                document.getElementById("sum-subject").value = Number( document.getElementById("sum-subject").value) - Number( subjectCost )
                inp.parentNode.remove();
                
            }
        </script>
    @endsection
