
 @extends('frontend.rcms.layout.main_rcms')
 @section('rcms_container')
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
     <script>
         function openTab(tabName, ele) {
             let buttons = document.querySelector('.process-groups').children;
             let tables = document.querySelector('.process-tables-list').children;
             for (let element of Array.from(buttons)) {
                 element.classList.remove('active');
             }
             ele.classList.add('active')
             for (let element of Array.from(tables)) {
                 element.classList.remove('active');
                 if (element.getAttribute('id') === tabName) {
                     element.classList.add('active');
                 }
             }
         }
     </script>
 
     <style>
         header .header_rcms_bottom {
             display: none;
         }
 
         .filter-sub {
             display: flex;
             gap: 16px;
             margin-left: 13px
         }
     </style>
     <div id="rcms-desktop">
 
         <div class="process-groups">
             <div class="active" onclick="openTab('internal-audit', this)">Market Complaint Log </div>
 
         </div>
 
 
         <div class="main-content">
             <div class="container-fluid">
                 <div class="process-tables-list">
 
                     <div class="process-table active" id="internal-audit">
 
                         <div class="scope-bar">
                             <button style="width: 70px;"" class="print-btn theme-btn-1">Print</button>
                         </div>
                         <div class="table-block" style="">
                             <div class="table-responsive" style="height: 73vh">
                                 <table class="table table-bordered" style="width: 100%;">
                                     <tbody>
                                         <thead class="thead-dark">
                                             <tr>
                                                 <th style="width: 5%;">Sr.No.</th>
                                                 <th>Complaint No.</th>
                                                 <th>Date of receipt</th>
                                                 <th>Product Details</th>
                                                 <th>Product Name & Strength</th>
                                                 <th>batch No.</th>
                                                 <th>Mfg. date</th>
                                                 <th>Exp. Date</th>
                                                 <th>Nature of Complaint</th>
                                                 <th>Category of Complaint</th>
                                                 <th>Details of Complaint</th>
                                                 <th>Response / Report (Date)</th>
                                                 <th>Clouser date</th>
                                                 <th>Closed By </th>
                                                 <th>Repeated Complaint</th>
                                             </tr>
                                         </thead>
                                     <tbody>
                                         <tr>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                             <td>1</td>
                                         </tr>
                                         <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                         </tr>
                                         <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                         </tr>
                                         <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                         </tr>
                                         <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                         </tr>
                                         <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
 
     </div>
 
     <script>
         VirtualSelect.init({
             ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
         });
     </script>
 @endsection
 