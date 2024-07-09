@extends('member.layouts.app')
@section('content')
    <!-- Header Starts -->
    @include('member.layouts.header')
    <!-- Header Ends -->

    <!-- Main Content -->
    <section class="container-fluid pleft-56">
        <div class="row">
            <div class="col-md-3 pr-0 bid-tap">
                <div class="bid-inbox">
                    <div class="bid-header d-flex align-items-center">
                        <h1 class="mr-auto">Review List</h1>
                        <a href="#"  class="search-ico  float-right tablinks4 search_filter" data-option="search"></a>
                        <a href="#"  class="filter-ico float-right tablinks4 search_filter" data-option="filter"></a>
                    </div>
                    <div id="search" class="tabcontent4" style="display: none;">
                        <div class="my-quotes-search d-flex align-items-center justify-content-between">
                            <div class="account-search-box-main">
                                <input id="keyword" type="text" placeholder="Search by reference no." class="form-control">
                            </div>
                        </div>
                    </div>  
                    <div id="filter" class="tabcontent4" style="display: none;">
                        <div class="my-quotes-search d-flex align-items-center justify-content-left">
                            <select id="mode_filter" name="mode_filter" class="form-select">
                                <option value=" ">All</option>
                                <option value="today">Today </option>
                                <option value="yesterday">Yesterday </option>
                                <option value="last_week">Last week </option>
                                <option value="last_month">Last month </option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex w-100 justify-content-between b-bottom">
                        <!-- Tabs navs -->
                        <ul class="nav nav-tabs tab mb-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tablinks3" href="{{ route('member.reviewList.send') }}">Sent</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tablinks3 active" href="{{ route('member.reviewList.received') }}">Received</a>
                            </li>
                        </ul>
                        <!-- Tabs navs -->
                    </div>
                    <div class="tabcontent3" id="sent" style="display: block;">
                        <div id="send-list" class="list-group">
                            @forelse($enquiries as $key => $enquiry)
                                <a href="{{ route('member.reviewList.received',$enquiry->reference_no) }}" class="list-group-item list-group-item-action flex-column align-items-start enquiry_item received-bg-color">
                                    <div class="list-item-inner yellow-border">
                                        <i class="d-flex received-from">Received from {{ $enquiry->sender->name }}</i>
                                        <div class="d-flex justify-content-between">
                                            <h2 class="mb-2 round-bullet d-flex">
                                                {{ $enquiry->reference_no }}
                                                {{ $enquiry->share_priority_text ?? '' }}
                                            </h2>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <h3>{{ $enquiry->subject }}</h3>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="bid-date">{{ \Carbon\Carbon::parse($enquiry->created_at)->format('d F, Y') }}</small>
                                            <small class="bid-count d-flex align-items-center justify-content-center">{{ $enquiry->all_replies->count() }}</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                            <div class="vh-100 d-flex flex-column justify-content-center align-items-center w-100">
                                <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg" alt="Image description" class="img-fluid mb-3">
                                <h2>No Enquiries Received for Review</h2>
                                <p class="mt-4 text-center">Enquiries that have been received for review will be displayed here. At present, there are no enquiries to show.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
            @if($selected_enquiry)
            <div class="col-md-6 pl-0 pr-0 scnd-section-main">
                <div class="mid-sec-main">
                    <div class="mid-sec-header d-flex justify-content-between  justify-content-center">
                        <!-- Bid analysis rybbon starts -->
                        <div class="first-sec d-flex align-items-center" id="quote-options">
                            <div class="completed-screening d-flex align-items-center">
                                <small>Completed<br>Screening</small>
                                <h1><span class="green">{{ $selected_enquiry->action_replies->count() }}</span><span class="grey">/</span>{{ $selected_enquiry->all_replies->count() }}</h1>
                            </div>
                            <div class="completed-screening d-flex align-items-center">
                                <a href="#" class="share-with" data-id="{{ $selected_enquiry->id }}" data-reference_no="{{ $selected_enquiry->reference_no }}" data-subject="{{ $selected_enquiry->subject }}" data-date="$selected_enquiry->created_at }}">
                                    Shared by<br>
                                    <span class="name">{{ $selected_enquiry->sender->name }}</span>
                                </a>
                            </div>
                        </div>
                        <!-- Bid analysis rybbon ends -->
    
                        <div class="scond-sec d-flex align-items-center">
                            <!-- Bid notification starts -->
                            <div class="completed-screening d-flex align-items-center position-relative" style="border-right: 0px !important;">
                                <small class="alert-count d-flex align-items-center justify-content-center" id="pending-count">{{ $selected_enquiry->suggestions->count() }}</small>
                                <a href="#" class="alert-btn"></a>
                                <div id="mark-drop3">
                                <a href="#" class="dummy-btn d-flex"></a>
                                    <ul class="drop-notf" id="notify">
                                        @forelse($selected_enquiry->suggestions as $key => $suggestion)
                                        <li>
                                            New suggestion arrived!
                                        </li>
                                        @empty
                                        
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                            <!-- Bid notification ends -->

                            <!-- More Actions starts -->
                            <div class="d-flex align-items-center position-relative more-actions">
                                @if($selected_enquiry->is_reviewed == 0)
                                    <a class="ms-2 btn btn-secondary markReviewCompleted" data-id="{{ $selected_enquiry->id }}" data-reference_no="{{ $selected_enquiry->reference_no }}" data-reviewableCount="{{ $selected_enquiry->selected_replies->count() + $selected_enquiry->suggestions->count() }}">Mark as Reviewed</a>
                                @endif    
                            </div>
                            <!-- More Actions ends -->
                        </div>

                    </div>
                    <div id="my-quote">
                        <div class="mid-second-sec mid-yellow-bg">
                            <h3 class="text-warning">{{ $selected_enquiry->is_reviewed == 1 ? 'Review Completed' : 'Review In Process' }}</h3>
                            <div class="d-flex w-100 justify-content-between">
                                <h2 class="received-from-ico">{{ $selected_enquiry->subject }}</h2>
                                <small class="created-date"><span>Created on:</span><br>{{ $selected_enquiry->created_at }}</small>
                                <a href="#" class="question-asked">Questions Asked</a>
                            </div>
                            <h3>Quote For: {{ $selected_enquiry->sender->name }}, {{ $selected_enquiry->sender->designation }}, {{ $selected_enquiry->sender->company->name }}</h3>
                            <div class="position-relative msg-expand-main" id="msg-expand">
                                <article>{!! $selected_enquiry->body !!}
                                <hr>
                                <div class="position-relative d-flex justify-content-start align-item-center">
                                    <img src="{{ env('APP_URL') }}{{ $selected_enquiry->sender->company->logo }}" height="55px" />
                                    <p class="ms-4"><strong>{{ $selected_enquiry->sender->name }}</strong><br>{{ $selected_enquiry->sender->designation }}<br>{{ $selected_enquiry->sender->company->name }}</p>
                                </div>
                                <div class="position-relative d-flex justify-content-start align-item-center">
                                                <p style="font-size:9px;line-height: 1.1;text-align:justify;">Disclaimer: The information provided in this communication is intended solely for the recipient's 
                                                consideration and does not constitute any endorsement or guarantee by Dialectb2b.com. We cannot be held responsible 
                                                for the accuracy or reliability of the content herein. Recipients are advised to independently evaluate the products, services, 
                                                and businesses mentioned before entering into any agreements or transactions. Dialectb2b.com disclaims all liability for losses, 
                                                damages, or disputes arising from communications facilitated through our platform.</p>
                                            </div>
                                </article>
                                <h1 class="mt-2">{{ $selected_enquiry->attachments->count() != 0 ? 'Attachments' : '' }}</h1>
                                <div class="d-flex flex-column align-items-left float-start mt-2 attachments">
                                    @foreach($selected_enquiry->attachments as $key => $attachment)
                                    <span class="d-flex doc-preview align-items-center justify-content-between mb-2">
                                        {{ $attachment->file_name }}
                                        <div class="d-flex align-items-center">
                                            <a id="doc-preview-link" href="{{ config('setup.application_url') }}{{ $attachment->path }}" class="doc-preview-view" target="_blank"></a>
                                            <a id="doc-preview-link" href="{{ config('setup.application_url') }}{{ $attachment->path }}" class="" download>D</a>
                                        </div>
                                    </span>
                                    @endforeach
                                </div>
                                <a href="#" class="read-more">Read More</a>
                                <a href="#" class="read-less">Read Less</a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="mid-third-sec">

                        <div class="d-flex w-100 justify-content-between b-bottom">
                            <!-- Bid list tab buttons starts -->
                            <ul class="nav nav-tabs tab mb-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link tablinks active" onclick="openCity(event, 'all-bids')">All Bids</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tablinks" onclick="openCity(event, 'shortlisted')">Shortlisted</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tablinks" onclick="openCity(event, 'selected')">Selected</a>
                                </li>
                            </ul>
                            <!-- Bid list tab buttons ends -->
                        </div>
                       
                        <!-- All bids tab starts -->
                        <div id="all-bids" class="tabcontent" style="display: block;">
                            <div class="row bid-list-head d-flex align-items-center justify-content-center">
                                <div class="col-md-6">
                                    <a href="#" class="sort_company" data-status="true"> 
                                        Company Name 
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <a href="#" class="sort_date" data-status="true">
                                        Date
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <a href="#" class="sort_status" data-status="true">
                                         Status
                                         <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                            </div>
                            <ul id="all_replies_list" class="all-bid-ul">
                                @forelse($selected_enquiry->all_replies as $key => $all_reply)
                                    <li class="bid-detail" data-reply_id="{{ $all_reply->id }}">
                                        <div class="row all-bid-list d-flex align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <a href="#">{{ $all_reply->sender->company->name }}</a>
                                                <p>{{ $all_reply->short_content }}</p>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-center"><span
                                                    class="date">{{ $all_reply->created_at }}</span></div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-center"><span
                                                    class="status-change status-{{ $all_reply->status_color }}" title="{{ $all_reply->hold_reason }}">{{ $all_reply->status_text }}</span></div>
                                        </div>
                                    </li>
                                @empty
                                
                                @endforelse
                            </ul>
                        </div>
                        <!-- All bids tab ends -->

                        <!-- Shortlisted bids tab starts -->
                        <div id="shortlisted" class="tabcontent">
                            <div class="row bid-list-head d-flex align-items-center justify-content-center">
                                <div class="col-md-6">
                                    <a href="#" class="sort_company" data-status="true"> 
                                        Company Name 
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <a href="#" class="sort_date" data-status="true">
                                        Date
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <a href="#" class="sort_status" data-status="true">
                                         Status 
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                            </div>
                            <ul id="shortlisted_list" class="all-bid-ul">
                                @forelse($selected_enquiry->shortlisted_replies as $key => $shortlisted)
                                    <li class="bid-detail" data-reply_id="{{ $shortlisted->id }}">
                                        <div class="row all-bid-list d-flex align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <a href="#">{{ $shortlisted->sender->company->name }}</a>
                                                <p>{{ $shortlisted->short_content }}</p>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-center"><span
                                                    class="date">{{ $shortlisted->created_at }}</span></div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-center"><span
                                                    class="status-change status-{{ $shortlisted->status_color }}" title="{{ $shortlisted->hold_reason }}">{{ $shortlisted->status_text }}</span></div>
                                        </div>
                                    </li>
                                @empty
                                
                                @endforelse
                            </ul>
                        </div>
                        <!-- Shortlisted bids tab ends -->

                        <!-- Selected bids tab starts -->
                        <div id="selected" class="tabcontent">
                            <div class="row bid-list-head d-flex align-items-center justify-content-center">
                                <div class="col-md-6">
                                    <a href="#" class="sort_company" data-status="true"> 
                                        Company Name 
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <a href="#" class="sort_date" data-status="true">
                                        Date
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <a href="#" class="sort_status" data-status="true">
                                         Status 
                                        <i class="ic_sort"><img src="{{ asset('assets/images/ic_sort.svg') }}"></i>
                                    </a>
                                </div>
                            </div>
                            <ul id="selected_list" class="all-bid-ul">
                               @forelse($selected_enquiry->selected_replies as $key => $selected)
                                    <li class="bid-detail" data-reply_id="{{ $selected->id }}">
                                        <div class="row all-bid-list d-flex align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <a href="#">{{ $selected->sender->company->name }}</a>
                                                <p>{{ $selected->short_content }}</p>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-center"><span
                                                    class="date">{{ $selected->created_at }}</span></div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-center"><span
                                                    class="status-change status-{{ $selected->status_color }}" title="{{ $selected->hold_reason }}">{{ $selected->status_text }}</span></div>
                                        </div>
                                    </li>
                                @empty
                                
                                @endforelse
                            </ul>
                        </div>
                        <!-- Selected bids tab ends -->

                    </div>

                </div>
            </div>

            <!-- Bid read pane starts -->
            <div class="col-md-6 pl-0 bid-open">
                
            </div>
            <!-- Bid read pane ends -->

            <!-- Faq section starts -->
            <div class="col-md-3 pl-0 questions-ask">
                <div class="last-sec-main">
                    <div class="last-sec-main-inner">
                        <div class="d-flex justify-content-between last-sec-header">
                            <h1>Questions Asked</h1>
                            <a href="#" class="cross"></a>
                        </div>

                        <div class="d-flex w-100 justify-content-between b-bottom">
                            <!-- Faq tabs buttons starts -->
                            <ul class="nav nav-tabs tab mb-2" role="tablist2">
                                <li class="nav-item">
                                    <a class="nav-link tablinks2 faq active" data-option="open">Open</a>
                                    <small id="open-count" class="tab-notf-count d-flex align-items-center justify-content-center">{{ $selected_enquiry->open_faqs->count() }}</small>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tablinks2 faq" data-option="closed">Closed</a>
                                    <small id="closed-count" class="tab-notf-count d-flex align-items-center justify-content-center">{{ $selected_enquiry->closed_faqs->count() }}</small>
                                </li>
                            </ul>
                            <!-- Faq tabs buttons ends -->
                        </div>
                        <!-- Open questions tab starts -->
                        <div id="open" class="tabcontent2 scroll-q-asked" style="display: block;">
                            @forelse($selected_enquiry->open_faqs as $key => $open_faq)
                                <div class="open-close-list">
                                    <h4>{{ $open_faq->question }}</h4>
                                    <small class="bid-date">{{ $open_faq->created_at }}</small>
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="respo-skip-btn">
                                            @if($open_faq->status == 0)
                                                <a href="#" class="respond" data-id="{{ $open_faq->id }}" data-question="{{ $open_faq->question }}">Respond</a>
                                                <a href="#" class="skip" data-id="{{ $open_faq->id }}">Skip</a> 
                                            @else
                                                 <span class="skiped-status">Skipped</span>
                                            @endif
                                        </div>
                                        <div class="dropdown">
                                            <button onclick="myFunction()" class="dropbtn mt-2">Report</button>
                                            <div id="myDropdown" class="dropdown-content"> 
                                                <a href="#" class="report" data-category="question" data-type="Spam" data-enquiry_id="{{ $selected_enquiry->id }}" data-question_id="{{ $open_faq->id }}">Spam</a>
                                                <a href="#" class="report" data-category="question" data-type="Illegal activity" data-enquiry_id="{{ $selected_enquiry->id }}" data-question_id="{{ $open_faq->id }}">Illegal activity</a>
                                                <a href="#" class="report" data-category="question" data-type="Advertisement" data-enquiry_id="{{ $selected_enquiry->id }}" data-question_id="{{ $open_faq->id }}">Advertisement</a>
                                                <a href="#" class="report" data-category="question" data-type="Cyberbullying" data-enquiry_id="{{ $selected_enquiry->id }}" data-question_id="{{ $open_faq->id }}">Cyberbullying</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            
                            @endforelse
                        </div>
                        <!-- Open questions tab ends -->

                        <!-- Closed questions tab starts -->
                        <div id="closed" class="tabcontent2 scroll-q-asked" style="display: none;">
                            @forelse($selected_enquiry->closed_faqs as $key => $closed_faq)
                                <div class="open-close-list">
                                    <h4>{{ $closed_faq->question }}</h4>
                                    <small class="bid-date">{{ $closed_faq->created_at }}</small>
                                    <div class="colsed-description">
                                        {{ $closed_faq->answer }}
                                        <span>You Answered on {{ $closed_faq->answered_at }}</span>
                                    </div>
                                    <a href="#" class="respond" data-id="{{ $closed_faq->id }}" data-question="{{ $closed_faq->question }}" data-answer="{{ $closed_faq->answer }}">Edit Response</a>
                                </div>
                            @empty
                            
                            @endforelse
                        </div>
                        <!-- Closed questions tab ends -->

                    </div>

                </div>
            </div>
            @else
            <div class="col-md-9">
                <div class="vh-100 d-flex flex-column justify-content-center align-items-center w-100">
                    
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- End Main Content -->

    <!-- Faq answer model starts -->
    @include('member.inbox.faq-popup')
    <!-- Faq answer model ends -->

    <!-- Faq answer model starts -->
    @include('member.reviewlist.received.suggestion-popup')
    <!-- Faq answer model ends -->

    <input type="hidden" id="answer-faq-url" value="{{ route('member.answerFaq') }}" />
    <input type="hidden" id="skip-faq-url" value="{{ route('member.skipFaq') }}" />
    <input type="hidden" id="report-action-url" value="{{ route('member.report') }}" />
    
@push('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $( function() {        
        
        $('body').on('click','.search_filter',function(){
            
            var search_filter = $(this).data('option');

            if(search_filter === "search"){
                $('#filter').hide();
                $('#search').show();
            }
            else if(search_filter === "filter"){
                $('#filter').show();
                $('#search').hide();
            }
            else{
                $('#filter').hide();
                $('#search').hide();
            }
        });

        $('body').on('keyup','#keyword',function(){
            //loadReviewSendList();
        });

        $('body').on('change','#mode_filter',function(){
            //loadReviewSendList();
        });

        $('body').on('click','.read-more',function () {
            $('#msg-expand').removeClass('msg-expand-main');
            $('#msg-expand').addClass('msg-less-main');
            $('.read-more').hide();
            $('.read-less').show();
            $("ul.all-bid-ul").css("height", "calc(100vh - 646px)");
        });

        $('body').on('click','.read-less',function () {
            $('#msg-expand').addClass('msg-expand-main');
            $('#msg-expand').removeClass('msg-less-main');
            $('.read-more').show();
            $('.read-less').hide();
            $("ul.all-bid-ul").css("height", "calc(100vh - 369px)");
        });

        $('body').on('click','.faq',function(){
            $('.faq').removeClass('active');
            $(this).addClass('active');
            var faq_filter = $(this).data('option');
            
            if(faq_filter === "open"){
                $('#closed').hide();
                $('#open').show();
            }
            else if(faq_filter === "closed"){
                $('#closed').show();
                $('#open').hide();
            }
            else{
                $('#closed').hide();
                $('#open').hide();
            }
        });

        $('body').on('click','.question-asked',function () {
            $('.questions-ask').show('300');
            $('.scnd-section-main').removeClass('col-md-9');
            $('.scnd-section-main').addClass('col-md-6');
            $('.question-asked').hide();
        });

        $('body').on('click','.respond',function () {
            var id = $(this).data('id');
            var question = $(this).data('question');
            var answer = $(this).data('answer');
            $('#faq_id').val(id);
            $('#question').text(question);
            $('#answer').text(answer);
            $('#answer-question').modal('show');
        });

        $('body').on('click','.skip',function () {
            var skipFaqAction = $('#skip-faq-url').val();
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to skip this question!",
                icon: 'warning',
                showCancelButton: true,
            }).then(function (willUpdate) {
                if (willUpdate.isConfirmed === true) {
                    axios.post(skipFaqAction, {id:id})
                            .then((response) => {
                            // Handle success response
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: response.data.message,
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });
                            window.location.reload();
                            })
                            .catch((error) => { 
                            // Handle error response
                            console.log(error);
                            });
                }
                else{
                    Swal.fire({
                        title: 'Cancelled',
                        icon: "error",
                    });
                }
            });
            
        });

        $('body').on('click','#save-answer',function () {
            var answerFaqAction = $('#answer-faq-url').val();
            var answer = $('#answer').val();
            var id = $('#faq_id').val();
            axios.post(answerFaqAction, {id:id, answer : answer})
                .then((response) => {
                    // Handle success response
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: "Updated",
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    $('#answer').val(' ');
                    $('#answer').removeClass('red-border');
                    $('.invalid-msg2').text(' ');
                    window.location.reload();
                    $('#answer-question').modal('hide');
                })
                .catch((error) => { 
                    // Handle error response
                    if (error.response.status == 422) {
                        $.each(error.response.data.errors, function(field, errors) {
                            var textarea = $('textarea[name="' + field + '"]');
                            textarea.addClass('red-border');
                            var textareafeedback = textarea.siblings('.invalid-msg2');
                            textareafeedback.text(errors[0]).show();
                        });
                    }      
                });
        });

        $('body').on('click','.report',function () {
                var category = $(this).data('category');
                var type = $(this).data('type');
                var enquiry_id = $(this).data('enquiry_id');
                var question_id = $(this).data('question_id');
                var reportAction = $('#report-action-url').val();
                axios.post(reportAction, {category:category,type:type,enquiry_id:enquiry_id,question_id:question_id})
                .then((response) => {
                // Handle success response
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: response.data.message,
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                })
                .catch((error) => { 
                // Handle error response
                console.log(error);
                });
        });

        $('body').on('click','.bid-detail',function () {
            $('.bid-open').empty();
            $('.bid-tap, .questions-ask').hide('500');
            $('.bid-open').show('500');

            $('.scnd-section-main').removeClass('col-md-9');
            $('.scnd-section-main').addClass('col-md-6');
            var reply_id = $(this).data('reply_id');
            var readReplyAction = "{{ route('member.readReply') }}";
            axios.post(readReplyAction, {reply_id:reply_id})
                .then((response) => {
                    var reply = response.data.reply;
                            $('.bid-open').append(`<div class="bid-detail-head">
                                <div class="d-flex">
                                    <h1>${reply.sender_company.name}</h1>
                                    ${reply.sender_company.status == 2 ?
                                        `<span class="verified">Verified</span>` :
                                            `<span class="not-verified">Not Verified</span>` }
                                </div>
                                <div class="d-flex date-status">
                                    Date <h2>${reply.created_at}</h2> <span class="status">${reply.status_text}</span>
                                </div>
                                <div class="d-flex mt-3 justify-content-between">
                                
                                    <div class="add-hold-btn d-flex">
                                        ${reply.status == 1 ? 
                                            reply.is_selected == 0 && reply.is_ignored == 0 ? `<a href="#" class="mark-as-selected" data-reply_id="${reply.id}">Select</a><a href="#" class="ignore" data-reply_id="${reply.id}">Ignore</a>`  : `` 
                                            : ``
                                        }
                                        
                                        ${reply.status == 1 ? 
                                            reply.is_selected == 1 && reply.is_ignored == 0 ? `<a href="#" class="ignore" data-reply_id="${reply.id}">Ignore</a>`  : `` 
                                            : ``
                                        }
                                        
                                        ${reply.status == 1 ? 
                                            reply.is_selected == 0 && reply.is_ignored == 1 ? `<a href="#" class="mark-as-selected" data-reply_id="${reply.id}">Select</a>`  : `` 
                                            : ``
                                        }
                                        
                                        ${reply.status !== 1 ? 
                                            reply.is_recommanded == 0  && reply.is_ignored == 0 ?
                                                `<a href="#"  id="add-comment-btn"  data-id="${reply.id}"  class="add-msg-ico">Recommand</a><a href="#" class="ignore" data-reply_id="${reply.id}">Ignore</a>`  : `` 
                                            : ``
                                        }
                                        
                                        ${reply.status !== 1 ? 
                                            reply.is_recommanded == 1  && reply.is_ignored == 0   ?
                                                `<a href="#" class="ignore" data-reply_id="${reply.id}">Ignore</a>`  : `` 
                                            : ``
                                        }
                                        
                                        ${reply.status !== 1 ? 
                                            reply.is_recommanded == 0 && reply.is_ignored == 1  ?
                                                `<a href="#"  id="add-comment-btn"  data-id="${reply.id}"  class="add-msg-ico">Recommand</a>`  : `` 
                                            : ``
                                        }

                                        ${reply.suggested_remarks != null ?
                                            `<a href="#" class="tooltip-msg">
                                                <span class="tooltiptext">
                                                    <span class="tooltip-arrow"></span>
                                                    ${reply.suggested_remarks}
                                                </span>
                                            </a>` : `` }
                                        
                                    </div>

                                    

                                    <div class="dropdown">
                                        <button onclick="myFunction()" class="dropbtn">Report</button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="#" class="report" data-category="reply" data-type="Spam" data-enquiry_id="${reply.enquiry_id}" data-question_id="${reply.id}">Spam</a>
                                            <a href="#" class="report" data-category="reply" data-type="Illegal activity" data-enquiry_id="${reply.enquiry_id}" data-question_id="${reply.id}">Illegal activity</a>
                                            <a href="#" class="report" data-category="reply" data-type="Advertisement" data-enquiry_id="${reply.enquiry_id}" data-question_id="${reply.id}">Advertisement</a>
                                            <a href="#" class="report" data-category="reply" data-type="Cyberbullying" data-enquiry_id="${reply.enquiry_id}" data-question_id="${reply.id}">Cyberbullying</a>
                                        </div>
                                    </div>

                                  

                                </div>
                                <a href="#" class="cross-second"></a>
                            </div>

                            <div class="bid-detail-content">
                                <article>${reply.body}
                                <hr>
                                <div class="position-relative d-flex justify-content-start align-item-center">
                                    <img src="{{ env('APP_URL') }}${reply.sender.company.logo}" height="55px" />
                                    <p class="ms-4"><strong>${reply.sender.name}</strong><br>${reply.sender.designation}<br>${reply.sender.company.name}</p>
                                </div>
                                <div class="position-relative d-flex justify-content-start align-item-center">
                                                <p style="font-size:9px;line-height: 1.1;text-align:justify;">Disclaimer: The information provided in this communication is intended solely for the recipient's 
                                                consideration and does not constitute any endorsement or guarantee by Dialectb2b.com. We cannot be held responsible 
                                                for the accuracy or reliability of the content herein. Recipients are advised to independently evaluate the products, services, 
                                                and businesses mentioned before entering into any agreements or transactions. Dialectb2b.com disclaims all liability for losses, 
                                                damages, or disputes arising from communications facilitated through our platform.</p>
                                            </div>
                                </article>

                                <h1 class="mt-2">${reply.attachments.length != 0 ? 'Attachments' : '' }</h1>
                                <div class="d-flex flex-wrap align-items-center reply-attachments">
                                    
                                </div>

                            </div>`);

                            reply.attachments.forEach(function(attachment) {
                            $('.reply-attachments').append(`<span class="d-flex doc-preview align-items-center justify-content-between mb-2 attachmets-list">
                                                            ${attachment.file_name}
                                                            <div class="d-flex align-items-center">
                                                                <a id="doc-preview-link" href="{{ config('setup.application_url') }}${attachment.path}" class="doc-preview-view" target="_blank"></a>
                                                                <a id="doc-preview-link" href="{{ config('setup.application_url') }}${attachment.path}" class="" download>D</a>
                                                            </div>
                                                        </span>`);
                });  
                })
                .catch((error) => { 
                    // Handle error response
                    
                });
        });

        $('body').on('click','.cross-second',function () {
            $('.bid-tap, .questions-ask').show('300');
            $('.bid-open').hide('300');
        });

        $('body').on('click','.mark-as-selected',function() {
                var reply_id = $(this).data('reply_id');
                var markSelectedAction = "{{ route('member.select') }}";
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to select this bid!",
                    icon: 'warning',
                    showCancelButton: true,
                }).then(function (willUpdate) {
                    if (willUpdate.isConfirmed === true) {
                        axios.post(markSelectedAction, {reply_id:reply_id})
                            .then((response) => {
                                Swal.fire({
                                            toast: true,
                                            icon: 'success',
                                            title: response.data.message,
                                            animation: false,
                                            position: 'top-right',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        });
                                        window.location.reload();
                                        $('.bid-tap, .questions-ask').show('300');
                                        $('.bid-open').hide('300');
                            })
                            .catch((error) => { 
                                // Handle error response
                                
                            });
                        }
                    else{
                        Swal.fire({
                            title: 'Cancelled',
                            icon: "error",
                        });
                    }
                });
            }); 
            
             $('body').on('click','.ignore',function() {
                var reply_id = $(this).data('reply_id');
                var markSelectedAction = "{{ route('member.ignore') }}";
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to ignore this bid!",
                    icon: 'warning',
                    showCancelButton: true,
                }).then(function (willUpdate) {
                    if (willUpdate.isConfirmed === true) {
                        axios.post(markSelectedAction, {reply_id:reply_id})
                            .then((response) => {
                                Swal.fire({
                                            toast: true,
                                            icon: 'success',
                                            title: response.data.message,
                                            animation: false,
                                            position: 'top-right',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        });
                                        window.location.reload();
                                        $('.bid-tap, .questions-ask').show('300');
                                        $('.bid-open').hide('300');
                            })
                            .catch((error) => { 
                                // Handle error response
                                
                            });
                        }
                    else{
                        Swal.fire({
                            title: 'Cancelled',
                            icon: "error",
                        });
                    }
                });
            });

            $('body').on('click','.unselect',function() {
                var reply_id = $(this).data('reply_id');
                var markUnSelectedAction = "{{ route('member.unselect') }}";
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to unselect this bid!",
                    icon: 'warning',
                    showCancelButton: true,
                }).then(function (willUpdate) {
                    if (willUpdate.isConfirmed === true) {
                        axios.post(markUnSelectedAction, {reply_id:reply_id})
                            .then((response) => {
                                Swal.fire({
                                        toast: true,
                                        icon: 'success',
                                        title: response.data.message,
                                        animation: false,
                                        position: 'top-right',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                    });
                                    window.location.reload();
                                    $('.bid-tap, .questions-ask').show('300');
                                    $('.bid-open').hide('300');
                            })
                            .catch((error) => { 
                                // Handle error response
                                
                            });
                        }
                    else{
                        Swal.fire({
                            title: 'Cancelled',
                            icon: "error",
                        });
                    }
                });
            }); 

        $('body').on('click','#add-comment-btn',function(){
             var id = $(this).data('id');
             $('#add-comment-id').val(id);
             $('#add-comments').modal('show');
        }); 

        $('body').on('click','.close',function(){
             $('#add-comments').modal('hide');
        });

        $('body').on('click','#save-comment',function(){
            var id = $('#add-comment-id').val();
            var comment = $('#comment').val();
            var saveSuggestionAction = "{{ route('member.reviewList.sendSuggestion') }}";
            axios.post(saveSuggestionAction, {id:id,comment:comment})
                 .then((response) => {
                    Swal.fire({
                        toast: true,
                        icon: 'success', 
                        title: "Updated",
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    window.location.reload();
                    $('#comment').val(' ');
                    $('#comment').removeClass('red-border');
                    $('.invalid-msg2').text(' ');
                    $('#add-comments').modal('hide'); 
                 })
                 .catch((error) => {
                    if (error.response.status == 422) {
                        $.each(error.response.data.errors, function(field, errors) {
                            var textarea = $('textarea[name="' + field + '"]');
                            textarea.addClass('red-border');
                            var textareafeedback = textarea.siblings('.invalid-msg2');
                            textareafeedback.text(errors[0]).show();
                        });
                    }     
                 });
        });



    });


    
      


    $('body').on('click','.markReviewCompleted',function(){
        var id = $(this).data('id');
        var reference_no = $(this).data('reference_no');
        var reviewableCount = $(this).data('reviewablecount');
      
        var markReviewCompletedAction = "{{ route('member.reviewList.markAsReviewed') }}";
        
        if(reviewableCount > 0){
            
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to mark #"+reference_no+" as reviewed!",
                    icon: 'warning',
                    showCancelButton: true,
                }).then(function (willUpdate) {
                    if (willUpdate.isConfirmed === true) {
                        axios.post(markReviewCompletedAction, {id:id})
                             .then((response) => {
                                // Handle success response
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: response.data.message,
                                    animation: false,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                });
                                window.location.reload();
                             })
                             .catch((error) => { 
                                // Handle error response
                                console.log(error);
                            });
                    }
                });
                
        }
        else{
            Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Atlest 1 bid should be select or recommanded',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
        }
    });
    


    $('body').on('click','.sort_status',function() {
            var status = $(this).data('status');
            if(status === true){
                $(this).data("status",false)
            }
            else{
                $(this).data("status",true)
            }
            sortByStatus(status);
            sortByStatusShortlist(status);
        });

        $('body').on('click','.sort_date',function() {
            var status = $(this).data('status');
            if(status === true){
                $(this).data("status",false)
            }
            else{
                $(this).data("status",true)
            }
            sortByDate(status);
            sortByDateShortlist(status);
        });

        $('body').on('click','.sort_company',function() {
            var status = $(this).data('status');
            if(status === true){
                $(this).data("status",false)
            }
            else{
                $(this).data("status",true)
            }
            sortByCompany(status);
            sortByCompanyShortlist(status);
        });


    // Function to sort the bid list by company name
    function sortByCompanyShortlist(ascending) {
            const bidList = document.querySelector('#shortlisted_list');
            const bids = Array.from(bidList.children);

            bids.sort((a, b) => {
                const statusA = a.querySelector('.bid-detail').textContent.trim();
                const statusB = b.querySelector('.bid-detail').textContent.trim();

                if (ascending === true) {
                    return statusA.localeCompare(statusB);
                } else {
                    return statusB.localeCompare(statusA);
                }
            });

            bids.forEach((bid) => bidList.appendChild(bid));
        }

        function sortByCompany(ascending) {
            const bidList = document.querySelector('.all-bid-ul');
            const bids = Array.from(bidList.children);

            bids.sort((a, b) => {
                const statusA = a.querySelector('.bid-detail').textContent.trim();
                const statusB = b.querySelector('.bid-detail').textContent.trim();

                if (ascending === true) {
                    return statusA.localeCompare(statusB);
                } else {
                    return statusB.localeCompare(statusA);
                }
            });

            bids.forEach((bid) => bidList.appendChild(bid));
        }

        // Function to sort the bid list by status
        function sortByDate(ascending) {
            const bidList = document.querySelector('.all-bid-ul');
            const bids = Array.from(bidList.children);

            bids.sort((a, b) => {
                const statusA = a.querySelector('.date').textContent.trim();
                const statusB = b.querySelector('.date').textContent.trim();

                if (ascending === true) {
                    return statusA.localeCompare(statusB);
                } else {
                    return statusB.localeCompare(statusA);
                }
            });

            bids.forEach((bid) => bidList.appendChild(bid));
        }

        function sortByDateShortlist(ascending) {
            const bidList = document.querySelector('#shortlisted_list');
            const bids = Array.from(bidList.children);

            bids.sort((a, b) => {
                const statusA = a.querySelector('.date').textContent.trim();
                const statusB = b.querySelector('.date').textContent.trim();

                if (ascending === true) {
                    return statusA.localeCompare(statusB);
                } else {
                    return statusB.localeCompare(statusA);
                }
            });

            bids.forEach((bid) => bidList.appendChild(bid));
        }

        // Function to sort the bid list by status
        function sortByStatus(ascending) {
            const bidList = document.querySelector('.all-bid-ul');
            const bids = Array.from(bidList.children);

            bids.sort((a, b) => {
                const statusA = a.querySelector('.status-yellow, .status-green, .status-red').textContent.trim();
                const statusB = b.querySelector('.status-yellow, .status-green, .status-red').textContent.trim();

                if (ascending === true) {
                    return statusA.localeCompare(statusB);
                } else {
                    return statusB.localeCompare(statusA);
                }
            });

            bids.forEach((bid) => bidList.appendChild(bid));
        }

        function sortByStatusShortlist(ascending) {
            const bidList = document.querySelector('#shortlisted_list');
            const bids = Array.from(bidList.children);

            bids.sort((a, b) => {
                const statusA = a.querySelector('.status-yellow, .status-green, .status-red').textContent.trim();
                const statusB = b.querySelector('.status-yellow, .status-green, .status-red').textContent.trim();

                if (ascending === true) {
                    return statusA.localeCompare(statusB);
                } else {
                    return statusB.localeCompare(statusA);
                }
            });

            bids.forEach((bid) => bidList.appendChild(bid));
        }
    </script>
@endpush
 
@endsection    