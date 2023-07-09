<!-- aside -->
<div id="aside" class="app-aside modal fade nav-expand">
    <div class="left navside black dk" layout="column">
        <div class="navbar no-radius" style="background: #0cc2aa">
            <!-- brand -->
            <a class="navbar-brand" style="margin: auto">
                <div ui-include="{{ asset('images/najeb.png') }}"></div>

                <span class="hidden-folded inline"><img src="{{ asset('images/najeb.png') }}" alt="."></span>
            </a>
            <!-- / brand -->
        </div>
        <div flex-no-shrink>
            <div ui-include="'../views/blocks/aside.top.2.html'"></div>
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-stacked nav-active-primary">

                <ul class="nav" ui-nav>
                    @if (Route::has('dashboard'))
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe3fc;
                                        {{--                      <span ui-include="'../assets/images/i_0.svg'"></span> --}}
                                    </i>
                                </span>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                    @endif
                    @if (Route::has('students'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe8d3;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Students</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('students') }}">
                                        <span class="nav-text">All</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('students', 'current') }}">
                                        <span class="nav-text">Current</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('students', 'rejected') }}">
                                        <span class="nav-text">Rejected</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('student-requests') }}">
                                        <span class="nav-text">Requests <span class="pull-right label red">
                                                @php
                                                    $requestsCount = \App\Models\Student::where('state', 'new')->count();
                                                    echo $requestsCount;
                                                @endphp
                                            </span></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('add.student') }}">
                                        <span class="nav-text">Add student</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('change.student.password') }}">
                                        <span class="nav-text">Change password</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Route::has('packages'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe1db;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Packages</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('packages') }}">
                                        <span class="nav-text">All Packages</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('create-package') }}">
                                        <span class="nav-text">Create Package</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Route::has('subjects'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe865;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Subjects</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('subjects') }}">
                                        <span class="nav-text">All subjects</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('create.subject.step1') }}">
                                        <span class="nav-text">Create subject</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Route::has('subjects'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe431;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Lectures</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('lectures') }}">
                                        <span class="nav-text">All lectures</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('create.lecture') }}">
                                        <span class="nav-text">Create lecture</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Route::has('subscriptions'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe854;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Subscriptions</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('subscriptions') }}">
                                        <span class="nav-text">All subscriptions</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscriptions.pending') }}">
                                        <span class="nav-text">Pending <span class="pull-right label red">
                                                @php
                                                    $requestsCount = \App\Models\Payment::where('state', 'pending')->count();
                                                    echo $requestsCount;
                                                @endphp
                                            </span></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscriptions.approved') }}">
                                        <span class="nav-text">Approved </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscriptions.rejected') }}">
                                        <span class="nav-text">Rejected</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Route::has('notification.create'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe7f7;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Notifications</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('notification.create') }}">
                                        <span class="nav-text">Broadcast</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('notification.create', ['search' => true]) }}">
                                        <span class="nav-text">Send</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-label"> --}}
                {{--                    <b class="label rounded label-sm primary">5</b> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe5c3; --}}
                {{--                      <span ui-include="'../assets/images/i_1.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Apps</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub"> --}}
                {{--                            <li> --}}
                {{--                                <a href="inbox.html"> --}}
                {{--                                    <span class="nav-text">Inbox</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="contact.html"> --}}
                {{--                                    <span class="nav-text">Contacts</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="calendar.html"> --}}
                {{--                                    <span class="nav-text">Calendar</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}

                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe8f0; --}}
                {{--                      <span ui-include="'../assets/images/i_2.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Layouts</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub"> --}}
                {{--                            <li> --}}
                {{--                                <a href="headers.html"> --}}
                {{--                                    <span class="nav-text">Header</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="asides.html"> --}}
                {{--                                    <span class="nav-text">Aside</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="footers.html"> --}}
                {{--                                    <span class="nav-text">Footer</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}

                {{--                    <li> --}}
                {{--                        <a href="widget.html"> --}}
                {{--                  <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe8d2; --}}
                {{--                      <span ui-include="'../assets/images/i_3.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Widgets</span> --}}
                {{--                        </a> --}}
                {{--                    </li> --}}

                {{--                    <li class="nav-header hidden-folded"> --}}
                {{--                        <small class="text-muted">Components</small> --}}
                {{--                    </li> --}}

                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-label"> --}}
                {{--                    <b class="label label-sm accent">8</b> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe429; --}}
                {{--                      <span ui-include="'../assets/images/i_4.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">UI kit</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub nav-mega nav-mega-3"> --}}
                {{--                            <li> --}}
                {{--                                <a href="arrow.html"> --}}
                {{--                                    <span class="nav-text">Arrow</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="box.html"> --}}
                {{--                                    <span class="nav-text">Box</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="button.html"> --}}
                {{--                                    <span class="nav-text">Button</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="color.html"> --}}
                {{--                                    <span class="nav-text">Color</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="dropdown.html"> --}}
                {{--                                    <span class="nav-text">Dropdown</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="grid.html"> --}}
                {{--                                    <span class="nav-text">Grid</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="icon.html"> --}}
                {{--                                    <span class="nav-text">Icon</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="label.html"> --}}
                {{--                                    <span class="nav-text">Label</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="list.html"> --}}
                {{--                                    <span class="nav-text">List Group</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="modal.html"> --}}
                {{--                                    <span class="nav-text">Modal</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="nav.html"> --}}
                {{--                                    <span class="nav-text">Nav</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="progress.html"> --}}
                {{--                                    <span class="nav-text">Progress</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="social.html"> --}}
                {{--                                    <span class="nav-text">Social</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="sortable.html"> --}}
                {{--                                    <span class="nav-text">Sortable</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="streamline.html"> --}}
                {{--                                    <span class="nav-text">Streamline</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="timeline.html"> --}}
                {{--                                    <span class="nav-text">Timeline</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="map.vector.html"> --}}
                {{--                                    <span class="nav-text">Vector Map</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}

                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-label"><b class="label no-bg">9</b></span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe3e8; --}}
                {{--                      <span ui-include="'../assets/images/i_5.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Pages</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub nav-mega"> --}}
                {{--                            <li> --}}
                {{--                                <a href="profile.html"> --}}
                {{--                                    <span class="nav-text">Profile</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="setting.html"> --}}
                {{--                                    <span class="nav-text">Setting</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="search.html"> --}}
                {{--                                    <span class="nav-text">Search</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="faq.html"> --}}
                {{--                                    <span class="nav-text">FAQ</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="gallery.html"> --}}
                {{--                                    <span class="nav-text">Gallery</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="invoice.html"> --}}
                {{--                                    <span class="nav-text">Invoice</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="price.html"> --}}
                {{--                                    <span class="nav-text">Price</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="blank.html"> --}}
                {{--                                    <span class="nav-text">Blank</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="signin.html"> --}}
                {{--                                    <span class="nav-text">Sign In</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="signup.html"> --}}
                {{--                                    <span class="nav-text">Sign Up</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="forgot-password.html"> --}}
                {{--                                    <span class="nav-text">Forgot Password</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="lockme.html"> --}}
                {{--                                    <span class="nav-text">Lockme Screen</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="404.html"> --}}
                {{--                                    <span class="nav-text">Error 404</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="505.html"> --}}
                {{--                                    <span class="nav-text">Error 505</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}

                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe39e; --}}
                {{--                      <span ui-include="'../assets/images/i_6.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Form</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub"> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.layout.html"> --}}
                {{--                                    <span class="nav-text">Form Layout</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.element.html"> --}}
                {{--                                    <span class="nav-text">Form Element</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.validation.html"> --}}
                {{--                                    <span class="nav-text">Form Validation</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.select.html"> --}}
                {{--                                    <span class="nav-text">Select</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.editor.html"> --}}
                {{--                                    <span class="nav-text">Editor</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.picker.html"> --}}
                {{--                                    <span class="nav-text">Picker</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.wizard.html"> --}}
                {{--                                    <span class="nav-text">Wizard</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="form.dropzone.html" class="no-ajax"> --}}
                {{--                                    <span class="nav-text">File Upload</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}

                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe896; --}}
                {{--                      <span ui-include="'../assets/images/i_7.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Tables</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub"> --}}
                {{--                            <li> --}}
                {{--                                <a href="static.html"> --}}
                {{--                                    <span class="nav-text">Static table</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="datatable.html"> --}}
                {{--                                    <span class="nav-text">Datatable</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a href="footable.html"> --}}
                {{--                                    <span class="nav-text">Footable</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}
                {{--                    <li> --}}
                {{--                        <a> --}}
                {{--                  <span class="nav-caret"> --}}
                {{--                    <i class="fa fa-caret-down"></i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-label hidden-folded"> --}}
                {{--                    <b class="label label-sm info">N</b> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-icon"> --}}
                {{--                    <i class="material-icons">&#xe1b8; --}}
                {{--                      <span ui-include="'../assets/images/i_8.svg'"></span> --}}
                {{--                    </i> --}}
                {{--                  </span> --}}
                {{--                            <span class="nav-text">Charts</span> --}}
                {{--                        </a> --}}
                {{--                        <ul class="nav-sub"> --}}
                {{--                            <li> --}}
                {{--                                <a href="chart.html"> --}}
                {{--                                    <span class="nav-text">Chart</span> --}}
                {{--                                </a> --}}
                {{--                            </li> --}}
                {{--                            <li> --}}
                {{--                                <a> --}}
                {{--                      <span class="nav-caret"> --}}
                {{--                        <i class="fa fa-caret-down"></i> --}}
                {{--                      </span> --}}
                {{--                                    <span class="nav-text">Echarts</span> --}}
                {{--                                </a> --}}
                {{--                                <ul class="nav-sub"> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-line.html"> --}}
                {{--                                            <span class="nav-text">line</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-bar.html"> --}}
                {{--                                            <span class="nav-text">Bar</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-pie.html"> --}}
                {{--                                            <span class="nav-text">Pie</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-scatter.html"> --}}
                {{--                                            <span class="nav-text">Scatter</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-radar-chord.html"> --}}
                {{--                                            <span class="nav-text">Radar &amp; Chord</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-gauge-funnel.html"> --}}
                {{--                                            <span class="nav-text">Gauges &amp; Funnel</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                    <li> --}}
                {{--                                        <a href="echarts-map.html"> --}}
                {{--                                            <span class="nav-text">Map</span> --}}
                {{--                                        </a> --}}
                {{--                                    </li> --}}
                {{--                                </ul> --}}
                {{--                            </li> --}}
                {{--                        </ul> --}}
                {{--                    </li> --}}

                {{--                    <li class="nav-header hidden-folded"> --}}
                {{--                        <small class="text-muted">Help</small> --}}
                {{--                    </li> --}}

                {{--                    <li class="hidden-folded"> --}}
                {{--                        <a href="docs.html"> --}}
                {{--                            <span class="nav-text">Documents</span> --}}
                {{--                        </a> --}}
                {{--                    </li> --}}

            </nav>
        </div>
        <div flex-no-shrink>
            <div ui-include="'../views/blocks/aside.bottom.0.html'"></div>
        </div>
    </div>
</div>
<!-- .modal -->
<div id="m-a-a" class="modal fade animate" data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <p>choose package first</p>

                <div class="box">
                    @php
                        $packages = \App\Models\Package::paginate(3);
                    @endphp
                    {{--                <div class="table-responsive" style="height: 150px"> --}}
                    {{--                    <table id="my-table" class="table table-striped b-t"> --}}
                    {{--                        <thead> --}}
                    {{--                        <tr> --}}
                    {{--                            <th></th> --}}
                    {{--                            <th>Name</th> --}}
                    {{--                            <th>Starts at</th> --}}
                    {{--                            <th>Ends at</th> --}}
                    {{--                        </tr> --}}
                    {{--                        </thead> --}}
                    {{--                        <tbody> --}}
                    {{--                        <!-- Package data will be loaded here --> --}}
                    {{--                        </tbody> --}}
                    {{--                    </table> --}}

                    {{--                </div> --}}
                    {{--                <ul id="my-pagination" class="pagination"></ul> --}}


                    <div id="table_data" class="table-responsive" style="height: 150px">
                        <table class="table table-striped b-t">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Starts at</th>
                                    <th>Ends at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td><label class="ui-check m-0"><input type="radio" id="id"
                                                    name="id" value="{{ $package->id }}" required><i
                                                    class="dark-white"></i></label></td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->start_date }}</td>
                                        <td>{{ $package->end_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {!! $packages->links() !!}
                    </div>
                </div>

                <span id="package_validation" class="label label-lg danger pos-rlt m-r-xs" style="display: none"><b
                        class="arrow top b-danger"></b><strong>you have to chooose</strong></span>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
            <a type="button" class="btn primary p-x-md" href="javascript:showfunction()">Add subject</a>
        </div>
    </div><!-- /.modal-content -->
</div>

<!-- / .modal -->
<!-- / aside -->
