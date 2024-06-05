    {{-- ======================================
                    TMS HEAD
    ======================================= --}}
    <div id="tms-head">
        <div class="head">Training Management System</div>
        <div class="link-list">
            {{-- <a style="cursor: pointer" onclick="

            window.open('/activity_log', '_blank', 'width=1200, height=900, top=0, left=0');"
                data-bs-toggle="tooltip" title="Training Log">
             Training Log
        </a> --}}

            <a href="{{ route('TMS.index') }}" class="tms-link">Dashboard</a>
            <a href="{{ route('employee_new') }}" class="tms-link">Employee</a>
            <a href="{{ route('trainer_qualification') }}" class="tms-link">Trainer Qualification</a>
            <div class="tms-drop-block">
                <div class="drop-btn">Quizzes&nbsp;<i class="fa-solid fa-angle-down"></i></div>
                <div class="drop-list">
                    <a href="/question">Question</a>
                    <a href="/question-bank">Question Banks</a>
                    <a href="{{ route('quize.index') }}">Manage Quizzes</a>
                </div>
            </div>
            <div class="tms-drop-block">
                <div class="drop-btn">Activities&nbsp;<i class="fa-solid fa-angle-down"></i></div>
                <div class="drop-list">
                    <a href="{{ route('TMS.create') }}">Create Training Plan</a>
                    <a href="{{ url('TMS/show') }}">Manage Training Plan</a>
                </div>
            </div>
        </div>
    </div>
