@extends('layouts.app')
@section('content')
    <!-- Header Starts -->
    @include('admin.layouts.onboard-header')
    <!-- Header Ends -->

    <!-- Account Creation  Starts -->
    <div class="container-fluid reg-bg">
        <section class="container">
            <div class="row registration">
                <h1>Registration</h1>
                <section class="reg-content-main">
                    <div class="reg-navigation-main">
                        <ul class="d-flex align-items-center">

                            <li class="d-flex align-items-center active-first-noradius">
                                <small class="reg-nav-count-active d-flex align-items-center justify-content-center">1</small>
                                Signup
                            </li>

                            <li class="d-flex align-items-center active-noradius">
                                <small class="reg-nav-count-active d-flex align-items-center justify-content-center">2</small>
                                Company<br>Information
                            </li>

                            <li class="d-flex align-items-center active-noradius">
                                <small class="reg-nav-count-active d-flex align-items-center justify-content-center">3</small>
                                Business<br>Category
                            </li>
                            <li class="d-flex align-items-center active">
                                <small class="reg-nav-count-active d-flex align-items-center justify-content-center">4</small>
                                Declaration
                            </li>
                            <li class="d-flex align-items-center review active-review">
                                <div class="bg-purple"></div>
                                <span class="verticalLine-active"></span>
                                <small class="round-active"></small>
                                Review
                                <br>Verification
                            </li>
                            <li class="d-flex align-items-center account-creation active">
                                <div class="account-corner-bg"></div>
                                <small class="reg-nav-count-active d-flex align-items-center justify-content-center">5</small>
                                Account<br>Creation
                            </li>
                            <li class="d-flex align-items-center completion">
                                <small class="reg-nav-count d-flex align-items-center justify-content-center">6</small>
                                Completion
                            </li>

                        </ul>
                        
                    </div>
                    
                    <section class="reg-content-sec">
                        <div class="signup-fields">
                            <div class="row mt-4">
                                <div class="col-md-12 setup-accnt">
                                    <h2>Setup your account</h2>
                                    <ul>
                                        <li>
                                            <div class="acc-list-main d-flex justify-content-between align-items-center justify-content-center">
                                                <span class="admin-profile">
                                                    Admin Profile
                                                </span>
                                                <div class="mid-section">
                                                    <span class="name">{{ $admin->name ?? '' }}</span>
                                                    <span class="email-blue">{{ $admin->email ?? '' }}</span>
                                                </div>
                                                <div class="right-sec d-flex align-items-center justify-content-end">
                                                    <span class="status-{{ $admin->password != '' ? 'active' : 'pending' }}">{{ $admin->password != '' ? 'Active' : 'Activation Pending' }}</span>
                                                    <a href="{{ route('admin.adminEdit') }}" class="edit-ico"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="acc-list-main d-flex justify-content-between align-items-center justify-content-center">
                                                @if($procurement)
                                                <span class="procurement-accnt">Procurement Account</span>
                                                <div class="mid-section">
                                                    <span class="name">{{ $procurement->name ?? '' }}</span>
                                                    <span class="email-blue">{{ $procurement->email ?? '' }}</span>
                                                </div>
                                                <div class="right-sec d-flex align-items-center justify-content-end">
                                                    <span class="status-{{ $procurement->password != '' ? 'active' : 'pending' }}">{{ $procurement->password != '' ? 'Active' : 'Activation Pending' }}</span>
                                                    <a href="{{ route('admin.procurementCreate') }}" class="edit-ico"></a>
                                                </div>
                                                @else
                                                <span class="procurement-accnt">Add Procurement Account</span>
                                                <div class="right-sec d-flex align-items-center justify-content-end">
                                                    <a href="{{ route('admin.procurementCreate') }}" class="pluse-ico"></a>
                                                </div>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div class="acc-list-main d-flex justify-content-between align-items-center justify-content-center">
                                                @if($sales)
                                                <span class="sales-accnt">Add Sales Account</span>
                                                <div class="mid-section">
                                                    <span class="name">{{ $sales->name ?? '' }}</span>
                                                    <span class="email-blue">{{ $sales->email ?? '' }}</span>
                                                </div>
                                                <div class="right-sec d-flex align-items-center justify-content-end">
                                                    <span class="status-{{ $sales->password != '' ? 'active' : 'pending' }}">{{ $sales->password != '' ? 'Active' : 'Activation Pending' }}</span>
                                                    <!-- <a href="{{ route('admin.salesCreate') }}" class="edit-ico"></a> -->
                                                </div>
                                                @else
                                                <span class="sales-accnt">Add Sales Account</span>
                                                <div class="right-sec d-flex align-items-center justify-content-end">
                                                    <a href="{{ route('admin.salesCreate') }}" class="pluse-ico"></a>
                                                </div>
                                                @endif
                                            </div>
                                            <form action="{{ route('admin.createUpdateUser') }}" method="post">
                                                @csrf
                                                <div class="expand-setup-accnt">
                                                    <div class="row mb-2">
                                                        <div class="col-md-12"><span class="mandatory">*All fields are mandatory!</span></div>
                                                    </div>
                                                    <div class="row">
                                                        <input type="hidden" name="user_id" value="{{ $sales->id ?? '' }}" />
                                                        <input type="hidden" name="role" value="3" />
                                                        <div class="col-md-4">
                                                            <div class="input-group position-relative">
                                                                <label>Name  <span class="mandatory">*</span></label>
                                                                <input id="name" type="text" name="name" value="{{ old('name') ?? $sales->name ?? '' }}" placeholder="Name" class="form-control @error('name') red-border @enderror" autofocus>
                                                                <div class="invalid-msg2">@error('name'){{ $message }}@enderror</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group position-relative">
                                                                <label>Designation<span class="mandatory">*</span></label>
                                                                <input id="designation" type="text" name="designation" value="{{ old('designation') ?? $sales->designation ?? '' }}" placeholder="Designation" class="form-control @error('designation') red-border @enderror">
                                                                <div class="invalid-msg2">@error('designation'){{ $message }}@enderror</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group position-relative">
                                                                <label>Email<span class="mandatory">*</span></label>
                                                                <input id="email" type="text" name="email" value="{{ old('email') ?? $sales->email ?? '' }}" placeholder="Email" class="form-control @error('email') red-border @enderror">
                                                                <div class="invalid-msg2">@error('email'){{ $message }}@enderror</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Mobile </label>
                                                            <div class="d-flex">
                                                                <input type="text" value="{{ $country->phonecode }}"  class="form-control mobile-code" readonly>
                                                                <input id="mobile" type="text" name="mobile" value="{{ old('mobile') ?? $sales->mobile ?? '' }}" placeholder="Mobile" class="form-control mobile-number @error('mobile') red-border @enderror">
                                                            </div>
                                                            <div class="invalid-msg2">@error('mobile'){{ $message }}@enderror</div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Land LIne </label>
                                                            <div class="d-flex">
                                                                <input type="text" value="{{ $country->phonecode }}" class="form-control mobile-code" readonly>
                                                                <input id="landline" type="text" name="landline" value="{{ old('landline') ?? $sales->landline ?? '' }}" placeholder="Landline" class="form-control mobile-number @error('landline') red-border @enderror">
                                                            </div>
                                                            <div class="invalid-msg2">@error('landline'){{ $message }}@enderror</div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Extension</label>
                                                            <input id="extension" type="text" name="extension" value="{{ old('extension') ?? $sales->extension ?? '' }}" placeholder="Extension" class="form-control @error('extension') red-border @enderror">
                                                            <div class="invalid-msg2">@error('extension'){{ $message }}@enderror</div>
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="save-continue-btn">Save and Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>

                                    <span class="accnt-note">Note:  All your account holders should verify and activate their respective accounts to complete the registration</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between justify-content-center">
                            <div class="already-signup">
                                <span class="need-help">Need help?</span> <span class="call-expert">Call an expert</span> <span class="expert-number">+974 123456</span>
                            </div>

                            <div class="form-group proceed-btn">
                                @if($admin->status == 1 && $procurement && $procurement->status == 1)
                                    <a id="submit" type="button" href="{{ route('admin.complete') }}" class="btn btn-secondary" tabindex="17">
                                        <!-- <i class="fa fa-repeat fa-spin text-white loader"></i> -->
                                        <span class="text-white">Proceed</span>
                                    </a>
                                @else  
                                    <a id="completemessage" type="button" class="btn btn-secondary" disabled>
                                        <span class="text-white">Proceed</span>
                                    </a>  
                                @endif
                            </div>

                        </div>
                    </section>

                </section>
            </div>
        </section>
    </div>
    <!-- Account Creation End -->
    @push('scripts')
<script>
    $(function(){
        $('body').on('click','#completemessage',function(){
            Swal.fire({
                title: 'Note',
                text: 'All account holders should activate their respective accounts to complete the registration.',
                icon: 'info',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Go to Home'
            });
        });
    });
</script>
@endpush
@endsection
 

   