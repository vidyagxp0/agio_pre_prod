
<div class="col-lg-12">
        <div class="button-block">
            <button type="button" class="printButton" onclick="saveAsPDF()">
                <i class="fas fa-download"></i> Save as PDF
            </button>
        </div>
     
                            <div class="certificate-container" id="certificate">
                                <h1 class="certificate-title">JOB TRAINING CERTIFICATE</h1>
                                </br>
                                <p class="certificate-content">
                                This is to certify that Mr. / Ms. / Mrs  <strong> {{ $jobTraining->name}}
                                    
                                </strong> has undergone On The Job Training</br>including the requirement of cGMP and has shown a good attitude and thorough</br>understanding in thè subject.</br></br>
                                </p> 
                                <p class="certificate-content">
                                Therefore we certify that Mr. Ms. / Mrs. <strong>{{ $jobTraining->name}}</strong> is capable of performing his /her </br>assigned duties in the <strong>{{$jobTraining->department}}</strong> Department </br>indeperndently. 
                                </p>
                                <div class="signature-section">
                                    <div class="signature">
                                        <div class="signature-line"></div>
                                        Sign / Date: <strong>{{ $jobTraining->evaluation_complete_by }} / {{ \Carbon\Carbon::parse($jobTraining->evaluation_complete_on)->format('d-M-Y') }}</strong> <br>Head of Department 
                                    </div>
                                    <div class="signature">
                                        <div class="signature-line"></div>
                                        Sign / Date: <strong>{{ $jobTraining->approval_complete_by }}/{{ \Carbon\Carbon::parse($jobTraining->approval_complete_on)->format('d-M-Y') }}</strong> <br>  Head QA/CQA
                                    </div>
                                </div>
                            </div>

    </div>


    <style>
    .certificate-container {
        width: 800px;
        height: 425px;
        border: 4px solid #0c0d0d;
        padding: 18px;
        background-color: white;
        position: relative;
        margin: auto;
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
    }
    .title-underline {
            border-top: 2px solid #0c0d0d;
            width: 60%;
            margin: 0 auto 35px auto;
        }
    
    .certificate-container h1,
    .certificate-container h2,
    .certificate-container p {
        text-align: center;
    }

    .certificate-title {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .certificate-content {
        font-size: 18px;
        line-height: 1.6;
        text-align: left;
        margin: 0 30px;
    }

    .signature-section {
        display: flex;
        justify-content: space-around;
        margin-top: 50px;
    }

    .signature {
        text-align: center;
        font-size: 16px;
    }

  

    @media print {
        .button-block {
            display: none !important;
        }

        body * {
            visibility: hidden;
        }

        .certificate-container,
        .certificate-container * {
            visibility: visible;
        }

        .certificate-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
        }
    }

    .button-block {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .printButton {
        background-color: #2c3e50;
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .printButton:hover {
        background-color: #1a252f;
    }

    .printButton i {
        margin-right: 8px;
    }
</style>

    <script>
        async function saveAsPDF() {
            const { jsPDF } = window.jspdf; 
            const certificateElement = document.getElementById("certificate");
            const canvas = await html2canvas(certificateElement);
            const imgData = canvas.toDataURL("image/png");
            const pdf = new jsPDF("landscape", "pt", "a4");
            const imgWidth = 750; 
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            pdf.addImage(imgData, "PNG", 0, 0, imgWidth, imgHeight);
            pdf.save("Trainer_Certificate.pdf");
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
