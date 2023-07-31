<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::is('backsite/dashboard') || Request::is('backsite/dashboard/*') ? 'active' : '' }}">
                <a href="/backsite/dashboard">
                    {{ Request::is('dashboard') ? 'active' : '' }}
                    <i class="{{ Request::is('backsite/dashboard') || Request::is('backsite/dashboard/*') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}" ></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Application"></i>
            </li>

            {{-- @can('management_access') --}}
                <li class=" nav-item"><a href=""><i class="{{ Request::is('backsite/permission') || Request::is('backsite/permission/*') || Request::is('backsite/permission') || Request::is('backsite/role') || Request::is('backsite/role/*') || Request::is('backsite/user') || Request::is('backsite/user/*') || Request::is('backsite/type_user') || Request::is('backsite/type_user/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span class="menu-title" data-i18n="Management Access">Management Access</span></a>
                    <ul class="menu-content">
                        {{-- @can('permission_access') --}}
                            <li class="{{ Request::is('backsite/permission') || Request::is('backsite/permission/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/permission">
                                    <i></i><span>Permission</span>
                                </a>
                            </li>
                        {{-- @endcan  --}}
                        {{-- @can('role_access') --}}
                            <li class="{{ Request::is('backsite/role') || Request::is('backsite/role/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/role">
                                    <i></i><span>Role</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                        {{-- @can('type_user_access') --}}
                            <li class="{{ Request::is('backsite/type_user') || Request::is('backsite/type_user/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/type_user">
                                    <i></i><span>Type User</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                        {{-- @can('user_access') --}}
                            <li class="{{ Request::is('backsite/user') || Request::is('backsite/user/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/user">
                                    <i></i><span>User</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
            {{-- @endcan --}}

            {{-- @can('master_data_access') --}}
                <li class=" nav-item"><a href="#"><i class="{{ Request::is('backsite/specialist') || Request::is('backsite/specialist/*') || Request::is('backsite/consultation') || Request::is('backsite/consultation/*') || Request::is('backsite/config_payment') || Request::is('backsite/config_payment/*') ? 'bx bx-customize bx-flashing' : 'bx bx-customize' }}"></i><span class="menu-title" data-i18n="Master Data">Master Data</span></a>
                    <ul class="menu-content">
                        {{-- @can('specialist_access') --}}
                            <li class="{{ Request::is('backsite/specialist') || Request::is('backsite/specialist/*')  ? 'active' : '' }} ">
                                    <a class="menu-item" href="/backsite/specialist">
                                    <i></i><span>Specialist</span>
                                </a>
                            </li>
                        {{-- @endcan --}}

                        {{-- @can('consultation_access') --}}
                            <li class="{{ Request::is('backsite/consultation') || Request::is('backsite/consultation/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/consultation">
                                    <i></i><span>Consultation</span>
                                </a>
                            </li>
                        {{-- @endcan --}}

                        {{-- @can('config_payment_access') --}}
                            <li class="{{ Request::is('backsite/config_payment') || Request::is('backsite/config_payment/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/config_payment">
                                    <i></i><span>Config Payment</span>
                                </a>
                            </li>
                        {{-- @endcan --}}

                    </ul>
                </li>
            {{-- @endcan --}}

            {{-- @can('operational_access') --}}
                <li class=" nav-item"><a href="#"><i class="{{ Request::is('backsite/doctor') || Request::is('backsite/doctor/*') || Request::is('backsite/hospital_patient') || Request::is('backsite/hospital_patient/*') || Request::is('backsite/appointment') || Request::is('backsite/appointment/*') || Request::is('backsite/transaction') || Request::is('backsite/transaction/*') ? 'bx bx-hive bx-flashing' : 'bx bx-hive' }}"></i><span class="menu-title" data-i18n="Operational">Operational</span></a>
                    <ul class="menu-content">

                        {{-- @can('doctor_access') --}}
                            <li class="{{ Request::is('backsite/doctor') || Request::is('backsite/doctor/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/doctor">
                                    <i></i><span>Doctor</span>
                                </a>
                            </li>
                        {{-- @endcan --}}

                        {{-- @can('hospital_patient_access') --}}
                            <li class="{{ Request::is('backsite/hospital_patient') || Request::is('backsite/hospital_patient/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/hospital_patient">
                                    <i></i><span>Hospital Patient</span>
                                </a>
                            </li>
                        {{-- @endcan --}}


                        {{-- here you can add nurse --}}


                        {{-- @can('appointment_access') --}}
                            <li class="{{ Request::is('backsite/appointment') || Request::is('backsite/appointment/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/appointment">
                                    <i></i><span>Appointment</span>
                                </a>
                            </li>
                        {{-- @endcan --}}

                        {{-- @can('transaction_access') --}}
                            <li class="{{ Request::is('backsite/transaction') || Request::is('backsite/transaction/*')  ? 'active' : '' }} ">
                                <a class="menu-item" href="/backsite/transaction">
                                    <i></i><span>Transaction</span>
                                </a>
                            </li>
                        {{-- @endcan --}}

                    </ul>
                </li>
            {{-- @endcan --}}

        </ul>
    </div>
</div>

<!-- END: Main Menu-->
