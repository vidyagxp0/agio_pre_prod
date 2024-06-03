@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <style>
        header {
            display: none;
        }
    </style>
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="division-config-modal">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('formDivision') }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="left-block">
                            <div class="head">
                                Site/Location
                            </div>
                            <div class="tab">
                                @php
                                    // Get the user's roles
                                    $userRoles = DB::table('user_roles')->where('user_id', Auth::user()->id)->get();
                                    // Initialize an empty array to store division IDs
                                    $divisionIds = [];
                                    // Loop through user's roles
                                    foreach($userRoles as $role) {
                                        // Store division IDs from user's roles
                                        $divisionIds[] = $role->q_m_s_divisions_id;
                                    }
                                    // Retrieve divisions where status = 1 and the division ID is in the array of division IDs
                                    $divisions = DB::table('q_m_s_divisions')->where('status', 1)->whereIn('id', $divisionIds)->get();
                                @endphp
                                @foreach ($divisions as $temp)
                                    <div class="divisionlinks">
                                        <input type="radio" value="{{ $temp->id }}" name="division_id"
                                            onclick="openDivision(event, {{ $temp->id }})" required>
                                        <div>{{ $temp->name }}</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="right-block">
                            <div class="head">
                                Process
                            </div>
                            @php
                            
                                $process = DB::table('q_m_s_processes')->get();
                                // dd($process);
                            @endphp
                            @foreach ($process as $temp)
                                <div id="{{ $temp->division_id }}" class="divisioncontent bg-light">
                                    @php
                                        // Get the user's roles
                                        $userRoles = DB::table('user_roles')
                                                        ->where([
                                                            'user_id' => Auth::user()->id,
                                                            'q_m_s_divisions_id' => $temp->division_id
                                                        ])->get();

                                        // Initialize an empty array to store process IDs
                                        $processIds = [];

                                        // Loop through user's roles to store process IDs
                                        foreach($userRoles as $role) {
                                            $processIds[] = $role->q_m_s_processes_id;
                                        }

                                        // Ensure process IDs are unique
                                        $uniqueProcessIds = array_unique($processIds);

                                        // Fetch processes using unique process IDs
                                        $pro = DB::table('q_m_s_processes')
                                                ->whereIn('id', $uniqueProcessIds)
                                                ->get();

                                        // Use an associative array to store unique process names
                                        $uniqueProcesses = [];

                                        // Loop through processes to ensure unique process names
                                        foreach ($pro as $process) {
                                            if (!isset($uniqueProcesses[$process->process_name])) {
                                                $uniqueProcesses[$process->process_name] = $process;
                                            }
                                        }
                                        @endphp

                                        @foreach ($uniqueProcesses as $process)
                                            <label for="process">
                                                <input type="hidden" name="process_id" value="{{ $process->id }}">
                                                <input type="submit" class="bg-light text-dark"
                                                    style="width: 100%; height: 60%; background-color: #011627; color: #fdfffc; padding: 7px; border: 0px;"
                                                    bgcolor="#011627" border="0" type="submit" for="process"
                                                    value="{{ $process->process_name }}" name="process_name" required>
                                            </label>
                                            <br>
                                        @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
@endsection
