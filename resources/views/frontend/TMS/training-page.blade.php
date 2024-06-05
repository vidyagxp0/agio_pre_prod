@extends('frontend.layout.main')
@section('container')
<script type="text/javascript">
window.history.pushState({ page: 1 }, "", "");
window.addEventListener("popstate", function(event) {
  window.history.pushState({ page: 2 }, "", "");
  alert("You Can not back, please press the Close training button.");
});

</script>
    {{-- ======================================
                    HEAD BUTTONS
    ======================================= --}}
    <div id="training-page">
        <div class="container-fluid">

            <div class="training-head-block">
                <div class="time">
                    <div class="countdown"></div>
                </div>
                <div class="btns">
                    <a href="{{ route('TMS.index') }}"><button>Close Training</button></a>
                    @if($training->training_plan_type == "Read & Understand")
                    <button id="complete-training" class="d-none" style="padding: 10px 20px;" data-bs-toggle="modal" data-bs-target="#trainee-sign">Complete Training</button>
                    @endif
                    @if($training->training_plan_type == "Classroom Training")
                    <button id="complete-training" class="d-none" style="padding: 10px 20px;" data-bs-toggle="modal" data-bs-target="#trainee-sign">Complete Training</button>
                    @endif
                    @if($training->training_plan_type == "Read & Understand with Questions")
                    <button id="complete-training" class="d-none" onclick="location.href='{{ url('trainingQuestion',$document->id) }}';">Continue with Question</button>

                    @endif
                </div>
            </div>

            <div class="inner-block pdf-block">
                <div class="main-head">
                    {{-- SOP-000{{ $document->id }} --}}
                </div>
                <div class="inner-block-content">
                    <iframe id="theFrame" width="100%" height="800"
                        src="{{ url('documents/viewpdf/' . $document->id) }}#toolbar=0"></iframe>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="trainee-sign">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form action="{{ url('trainingComplete', $document->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="electronic-meaning">Electronic Signature Approved Meaning</label>
                            <select name="electronic-meaning">
                                <option selected>- Please Select -</option>
                                <option value="train-complete">Training Completed</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="email" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <textarea name="comment"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    var timer2 = "20:00"; // Set the initial time to 10 minutes
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);

        --seconds;

        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);

        seconds = (seconds < 0) ? 59 : seconds; // Adjust seconds when it reaches 0

        seconds = (seconds < 10) ? '0' + seconds : seconds;

        if (minutes == 0 && seconds == 0) {
            $("#complete-training").removeClass("d-none");
            alert('Time Complete Now Continue With Question');
            clearInterval(interval);
        }

        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
    }, 1000);
</script>

      

@endsection
