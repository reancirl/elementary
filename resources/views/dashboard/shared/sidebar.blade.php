<div class="c-sidebar-brand">
    {{-- <img class="c-sidebar-brand-full" src="{{ url('/assets/img/placeholder-white.png') }}" width="118" height="46" alt="Placeholder Logo"> --}}
    @php
        $school = \DB::table('school_info')->first();
    @endphp
    @if (isset($school->image))
        <img class="c-sidebar-brand-full" src="{{ url('/images') }}/{{ $school->image }}" width="118" height="46"
            alt="Placeholder Logo">
    @else
        <h3 class="c-sidebar-brand-full">LOGO HERE</h3>
    @endif
    <h5 class="c-sidebar-brand-minimized">LOGO HERE</h5>
    {{-- <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/coreui-signet-white.svg') }}" width="118" height="46" alt="CoreUI Logo"> --}}
</div>
<ul class="c-sidebar-nav">

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('dashboard.index') }}">
            <i class="cil-speedometer c-sidebar-nav-icon"></i>
            Dashboard
        </a>
    </li>

    @hasanyrole('admin')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('announcements.index') }}">
            <i class="cil-clipboard c-sidebar-nav-icon"></i>
            Announcements
        </a>
    </li>
    @endrole

    @hasanyrole('admin|cashier')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('fees.index') }}">
            <i class="cil-money c-sidebar-nav-icon"></i>
            Fees
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('students.index') }}">
            <i class="cil-user-follow c-sidebar-nav-icon"></i>
            Students
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('enrolments.index') }}">
            <i class="cil-school c-sidebar-nav-icon"></i>
            Enrolment
        </a>
    </li>
    @endrole

    @role('admin')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('sections.index') }}">
            <i class="cil-view-column c-sidebar-nav-icon"></i>
            Sections
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('subjects.index') }}">
            <i class="cil-list c-sidebar-nav-icon"></i>
            Subjects
        </a>
    </li>
    @endrole

    @hasanyrole('admin|teacher')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('grades.index') }}">
            <i class="cil-paperclip c-sidebar-nav-icon"></i>
            Grades
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('sms.index') }}">
            <i class="cil-send c-sidebar-nav-icon"></i>
            SMS
        </a>
    </li>
    @endrole

    @role('admin')
    <li class="c-sidebar-nav-title">@lang('System')</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
            <i class="cil-people c-sidebar-nav-icon"></i>
            Users
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('school-years.index') }}">
            <i class="cil-calendar c-sidebar-nav-icon"></i>
            School Year
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('grade-levels.index') }}">
            <i class="cil-list-numbered c-sidebar-nav-icon"></i>
            Grade Levels
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('dashboard.schoolInfo') }}">
            <i class="cil-cog c-sidebar-nav-icon"></i>
            School Info
        </a>
    </li>
    @endrole

    @hasanyrole('student|parent')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('portal.grades') }}">
            <i class="cil-paperclip c-sidebar-nav-icon"></i>
            Grades
        </a>
    </li>
    @endrole

</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized"></button>
</div>
