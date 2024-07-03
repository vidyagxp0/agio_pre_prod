<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/userLogin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Aajh7Xx2LQl7nxiB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/analyticsData' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Voc6zXQrDM4B7Ydf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/dashboardStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Afdq4gH1CfIS2fAT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/getProfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::j9UlBvVaEszvj89v',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/capaStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jILjI3Cc98sw8Wwa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/filter-records' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'record.filter',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/upload-files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.upload.file',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k4joFz2fXFSOzYBT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logincheck' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lFX8NuzRPWTLLa9a',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms_check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oCHcITIJMoy6thhi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/error' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'error.route',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WPKltQYfYC7VGr2l',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data-fields' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hL4lQeiRRYwj7a9h',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-control' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-control/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documents' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documents.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'documents.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documents/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documents.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentExportPDF' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentExportPDF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentExportEXCEL' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentExportEXCEL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'csv.import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/importpdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bxnz09KJ0QiKHy9i',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/division_submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division_submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dcrDivision' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dcrDivision_submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentsContent' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentsContent/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sendforstagechanage' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ALGuQPelkZHsgqge',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'get.data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ENYIGRFJX0vdhuTv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::va8hlKCDYHQhoLmk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/advanceSearch' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8UeSelznAfGbuVzL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/mytaskdata' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::42zwBcyfKANx1AyD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/mydms' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cBRgYk8V8jznQeHz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8YBde93UaWpYwjDZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YNsTglkx7nrcCtbH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/analytics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kqFF9cLjsYT8qW3F',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/subscribe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cd9Nt5nuSO4fJB11',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/TMS' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/TMS/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/question' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'question.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/question/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/question-bank' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/question-bank/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/quize' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'quize.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'quize.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/quize/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'quize.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/qms-dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QzSYkUIRuKYcjD4s',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/capa' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ho2n3buhL2DTWPlE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/capastore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capastore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/managestore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'managestore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/risk-management' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5zYx2P9BS24gIwlm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/risk_store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'risk_store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/root-cause-analysis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IEAzqbu2GLSlqGrD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rootstore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'root_store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/auditee_store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auditee_store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/lab-incident' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::s7S8c1nxh8rviyhE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/audit-program' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hIoskr2AENJliR0X',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/emp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zCJnHkV1gSC8oFXY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tasks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QC48xf1a8wNSUd5S',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/review-details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZyJBAfYsT6FYTDq1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/audit-trial-inner' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::atMtEj5563U81ED1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new-pdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zLHAhn4nABWP0s7F',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new-login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eFrbUvkPszW2BGPP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/activity_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5xjaN0zlsmmu4f4j',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/helpdesk-personnel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UPO4tlpTjj45gE0I',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/designate-proxy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P4WRJHtzhiAb7ShC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/person-details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::b1VqYBwSLn7XAj1T',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/basic-search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O87l8b4vKwV2DBGU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create-training' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ACA78gHqhwIHnRTz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/example' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::j5iBpNKJK1lzrFTY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create-quiz' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HsCsNqePrVaevzBy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QaOH19pWEMVvxxxc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/training-page' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZJXtSHi5DuLqTUqD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/question-training' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7Xj3JTz0uTYu43vk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/edit-question' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NVPKRMOLPQASBXrz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-control-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::T7zDNO4YvB5eNOAj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-control-list-print' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vic5JiqisUBMv7lo',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-control-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hmeeD5QykB6YfQQ2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reviewer-panel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NyPtp9fgWbjOGCj1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-control-form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JYHZyenQ74MyyeTq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new-change-control' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gIDNsILe1ojIwOZi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/audit-pdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PyCpP61kwcdodCeU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/employee_new' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'employee_new',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/trainer_qualification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'trainer_qualification',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/chart-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::62UAMCn7fisVaziM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms_login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TaPtA5baYZxnrgAD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms_dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cq3Z0uZkQcUhmFE9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms_desktop' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qWfhBtrHWbTeJMOF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard_search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'main_dashboard_search',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms_reports' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::csWyZeNSoxT3WanT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Quality-Dashboard-Report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::I8EbHLPUffkctJRO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Supplier-Dashboard-Report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wMKEPqC9l5SC50V5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/QMSDashboardFormat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aYITVgLJw2WXAP8r',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/deviation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ONDiANvIuaqg3aOy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/extension_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZjvNNOuvSPBG3Wi5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cc-form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bWVJG35DhrUKB8ZW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/audit-management' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::78Qra3M89wmWIlEC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/out-of-specification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VgpcEQrOOLzM219C',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/action-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jfHSYCkSD7PkU3Gv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/effectiveness-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QkBtCjZs3D6JYsdH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/quality-event' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::V6Pe5uGpXb1Lhz0g',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/vendor-entity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x0tXoo48OVYqEq4P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/auditee' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PbE2pTazjq1kbgiE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/meeting' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FIzHip8cdoEQfwvD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/classroom-training' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FQ2tZ1o0sj19aPt5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/employee' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i4Xm5EcAsrYesoUc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/requirement-template' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::A4pKeyLOfgWZmFyA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/scar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zFVWlj24Bo6swdDU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/external-audit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3sYhAyOMjxbJkkS6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/contract' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LWbRputxTHkuAPnq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IJerLXqisGXQWr8G',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier-initiated-change' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tKnKyMHKT4rFp9Gi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier-investigation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::L5apdGL4wlS5m9DJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier-issue-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WKWOBmlR8BgJveDG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier-audit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ujKuJlKNhhmHMv9f',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/audit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lsz5m4vDcmFFJWtj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier-questionnaire' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jEk4NkaRPF6EMrS2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/substance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::huGvY9Gs0hfepHCp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/supplier-action-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YHYllsfr7F6JIYTS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/registration-template' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::D7F5ZQoK799hfQrw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/project' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1RodCiqAu8IMRA2p',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/extension' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jmQsdnKGQNvZY31N',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/observation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7bS3prf6Y3JSZsa4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new-root-cause-analysis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fvZciUQ2MfCIW2Vx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/help-desk-incident' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::c2GuIkpTYmPZmNR5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/review-management-report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6aiIGA49JMWaIL1P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/OOT_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CnCdyzCB44wVVzVl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/out_of_calibration' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ooc.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/OOC/view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ooc.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ooccreate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oocCreate',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/out_of_calibration_ooc' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JHTfLXyOYlxqY8gk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oos_micro' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos_micro.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oos_oot_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OVChnifAn8n8KjtL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change_control_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dAprGEmuLMTNMYmG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/market_complaint_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JUY0vtIHb3TZVxWv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/incident_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MIbcKpn2uyO1DQlV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/risk_management_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7LAdumjDMD3UyVc4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/errata_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Q1rZAX8OugSt0MSV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/laboratory_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SUy4i8eXuWU6di9U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/capa_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bDTxyfa37o0Wczxj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/non_conformance_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OTm1c3TfwrASaaG4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/deviation_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pUp7tjK0SBrs7nJQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/OOC_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::41RqO37YrHmsyY4x',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/OOS_OOT_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3Ygl6wENY591E675',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Failure_invst_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yNCF39MwpwfJglhC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/internal_audit_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YSnuHlABboqviMA3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/errata_new' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata_new',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/errata_view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5SlZwQN1rr9ZV5KN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tms/employee' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'employee.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tms/trainer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'trainer.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/errata/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/extension-new' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jqaVLNzxJjzLd6DD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/extension_new' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension_new.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yX3aVjm6HS3u3ASw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fOiTdUwUOrxvIxGl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z3lsoJTrrocyRSrY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QzFure4LxMIFuNZ5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/department' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'department.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'department.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/department/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'department.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/document_subtypes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/document_subtypes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/document_types' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/document_types/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/documentlanguage' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/documentlanguage/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/distributionlist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/distributionlist/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/GroupPermission' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/GroupPermission/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/division' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'division.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/division/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'process.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'process.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/process/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'process.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/risk-level' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/risk-level/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user_management' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/user_management/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/role_groups' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/role_groups/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/printcontrol' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/printcontrol/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/downloadcontrol' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/downloadcontrol/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'product.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/product/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'material.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/material/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/qms-division' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/qms-division/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/qms-process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/qms-process/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/rcms' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KGgpJSB0R0LOxKFe',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/rcms_login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Qras2DKrIp4Y0gwE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/rcms_dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GAYNjiK55yMgnmSN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/form-division' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9BJXYSXWOTvseGjd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rcms.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/CC' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'CC.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'CC.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/CC/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'CC.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/actionItem' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/actionItem/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/extension' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'extension.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/extension/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/qms-dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/summary_pdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dV8ZGHsyGGBd6vSV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/audit_trial_pdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mO2tOpotFaCDca6O',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/change_control_single_pdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sY1Tg3lxxtza4WfB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/change_control_family_pdf' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gUrcdkBvA6MA6Jxq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/effectiveness' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/effectiveness/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/helpdesk-personnel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3uGjJE2OPkNVuB4i',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/send-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vgHxR3FtppDq5SUC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/new-change-control' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZvTgz6M2ot1gPJxQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/audit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'createInternalAudit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/labcreate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'labIncidentCreate',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'createAuditProgram',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/observationstore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'observationstore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/formDivision' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'formDivision',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/deviation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/deviationstore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviationstore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/failure-investigation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tNExPLwBBqmgy8Cs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/oot' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oot.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/oot/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oot.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/oot/ootstore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oot.ootstore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/oos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/oos/oosstore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.oosstore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/marketcomplaint/market_complaint_new' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.market_complaint_new',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rcms/marketcomplaint/marketcomplaint/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.mcstore',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/c(?|h(?|ange\\-control(?|/([^/]++)(?|(*:44)|/edit(*:56)|(*:63))|\\-audit(?|/([^/]++)(*:90)|\\-detail/([^/]++)(*:114)))|ild(?|/([^/]++)(*:139)|_external/([^/]++)(*:165)))|apa(?|Update/([^/]++)(*:196)|show/([^/]++)(*:217)|/(?|stage/([^/]++)(*:243)|cancel/([^/]++)(*:266)|reject/([^/]++)(*:289)|Qa/([^/]++)(*:308))|_child/([^/]++)(*:332)))|/d(?|ivision/change/([^/]++)(*:370)|oc(?|uments(?|/(?|([^/]++)(?|(*:407)|/edit(*:420)|(*:428))|generatePdf/([^/]++)(*:457)|reviseCreate/([^/]++)(*:486)|printPDF/([^/]++)(*:511)|viewpdf/([^/]++)(*:535))|Content/([^/]++)(?|(*:563)|/edit(*:576)|(*:584)))|\\-details/([^/]++)(*:612))|ata(?|/([^/]++)(*:636)|g/([^/]++)(*:654))|eviation_child/([^/]++)(*:686))|/s(?|end\\-(?|notification/([^/]++)(*:729)|change\\-control/([^/]++)(*:761))|how/([^/]++)(*:782)|op/users(?:/([^/]++))?(*:812))|/r(?|e(?|v(?|ision/([^/]++)(*:848)|\\-details/([^/]++)(*:874))|ject_Risk/([^/]++)(*:901))|iskA(?|ssesment(?|Update/([^/]++)(*:943)|StateChange([^/]++)(*:970))|uditTrial/([^/]++)(*:997))|oot(?|Update/([^/]++)(*:1027)|show/([^/]++)(*:1049)|/(?|stage/([^/]++)(*:1076)|cancel/([^/]++)(*:1100)|reject/([^/]++)(*:1124))|AuditTrial/([^/]++)(*:1153))|cms/(?|CC/([^/]++)(?|(*:1184)|/edit(*:1198)|(*:1207))|s(?|end(?|\\-(?|initia(?|tor/([^/]++)(*:1253)|lQA/([^/]++)(*:1274))|hod/([^/]++)(*:1296)|c(?|ft\\-f(?|rom\\-QA/([^/]++)(*:1333)|ield/([^/]++)(*:1355))|ancel(?|\\-extention/([^/]++)(*:1393)|/([^/]++)(*:1411))|c/([^/]++)(*:1431))|e(?|xtension/([^/]++)(*:1462)|ffectiveness/([^/]++)(*:1492))|reject(?|\\-extention/([^/]++)(*:1531)|ion\\-field/([^/]++)(*:1559))|At/([^/]++)(*:1580))|stage/([^/]++)(*:1604))|ummary/([^/]++)(*:1629))|a(?|ction(?|Item/([^/]++)(?|(*:1667)|/edit(*:1681)|(*:1690))|\\-(?|stage\\-cancel/([^/]++)(*:1727)|item\\-audittrial(?|show/([^/]++)(*:1768)|details/([^/]++)(*:1793)))|item(?|SingleReport/([^/]++)(*:1832)|AuditReport/([^/]++)(*:1861)))|udit(?|\\-(?|trial/([^/]++)(*:1898)|detail/([^/]++)(*:1922))|/([^/]++)(*:1941)|DetailsLabIncident/([^/]++)(*:1977)|Program(?|Details/([^/]++)(*:2012)|SingleReport/([^/]++)(*:2042)|AuditReport/([^/]++)(*:2071))|_pdf/([^/]++)(*:2094)))|e(?|ffective(?|\\-audit\\-trial\\-(?|show/([^/]++)(*:2152)|details/([^/]++)(*:2177))|SingleReport/([^/]++)(*:2208)|AuditReport/([^/]++)(*:2237)|ness(?|/([^/]++)(?|(*:2265)|/edit(*:2279)|(*:2288))|\\-reject/([^/]++)(*:2315)))|xtension(?|_child/([^/]++)(*:2352)|/([^/]++)(?|(*:2373)|/edit(*:2387)|(*:2396))|\\-audit\\-trial(?|/([^/]++)(*:2432)|\\-details/([^/]++)(*:2459))|SingleReport/([^/]++)(*:2490)|AuditReport/([^/]++)(*:2519))|Check/([^/]++)(*:2543)|rrata(?|/stages(?|/([^/]++)(*:2579)|reject/([^/]++)(*:2603))|_(?|audit/([^/]++)(*:2631)|single_pdf/([^/]++)(*:2659))))|c(?|h(?|ild(?|/([^/]++)(*:2694)|_(?|audit_program/([^/]++)(*:2729)|management_Review/([^/]++)(*:2764)))|ange_control_single_pdf/([^/]++)(*:2807))|cView/([^/]++)/([^/]++)(*:2840)|a(?|ncel/([^/]++)(*:2866)|pa(?|SingleReport/([^/]++)(*:2901)|AuditReport/([^/]++)(*:2930))))|qms\\-dashboard(?|/([^/]++)/([^/]++)(*:2977)|_new/([^/]++)/([^/]++)(*:3008))|internal(?|AuditShow/([^/]++)(*:3047)|SingleReport/([^/]++)(*:3077)|auditReport/([^/]++)(*:3106))|update(?|/([^/]++)(*:3134)|LabIncident/([^/]++)(*:3163))|InternalAudit(?|StateChange/([^/]++)(*:3209)|Trial(?|Show/([^/]++)(*:3239)|Details/([^/]++)(*:3264)))|LabIncident(?|S(?|how/([^/]++)(*:3305)|tate(?|Change/([^/]++)(*:3336)|Two/([^/]++)(*:3357))|ingleReport/([^/]++)(*:3387))|C(?|ancel/([^/]++)(*:3415)|hild(?|Capa/([^/]++)(*:3444)|Root/([^/]++)(*:3466)))|Audit(?|Trial/([^/]++)(*:3499)|Report/([^/]++)(*:3523)))|RejectStateChange(?|Esign/([^/]++)(*:3568)|/([^/]++)(*:3586))|r(?|oot(?|_cause_analysis/([^/]++)(*:3630)|SingleReport/([^/]++)(*:3660)|AuditReport/([^/]++)(*:3689))|isk(?|SingleReport/([^/]++)(*:3726)|AuditReport/([^/]++)(*:3755))|cms/auditdetails/([^/]++)(*:3790)|eject/([^/]++)(*:3813))|Audit(?|Program(?|Show/([^/]++)(*:3854)|TrialShow/([^/]++)(*:3881)|Cancel/([^/]++)(*:3905))|StateChange/([^/]++)(*:3935)|RejectStateChange/([^/]++)(*:3970))|UpdateAuditProgram/([^/]++)(*:4007)|o(?|bservation(?|show/([^/]++)(*:4046)|update/([^/]++)(*:4070)|_(?|send_stage/([^/]++)(*:4102)|child/([^/]++)(*:4125)))|o(?|t(?|_(?|view/([^/]++)(*:4161)|audit_history/([^/]++)(*:4192))|/(?|update/([^/]++)(*:4221)|stage/([^/]++)(*:4244))|cSingleReport/([^/]++)(*:4276))|s/(?|oos(?|_view/([^/]++)(*:4311)|update/([^/]++)(*:4335))|s(?|endstage/([^/]++)(*:4366)|ingle_report/([^/]++)(*:4396))|re(?|questmoreinfo_back_stage/([^/]++)(*:4444)|ject_stage/([^/]++)(*:4472))|a(?|ssignable_send_stage/([^/]++)(*:4515)|udit(?|Details/([^/]++)(*:4547)|_report/([^/]++)(*:4572)))|ca(?|ncel_stage/([^/]++)(*:4607)|pa_child/([^/]++)(*:4633))|thirdStage/([^/]++)(*:4662)|AuditTrial/([^/]++)(*:4690))))|boostStage/([^/]++)(*:4721)|ObservationAuditTrial(?|Show/([^/]++)(*:4767)|Details/([^/]++)(*:4792))|ExternalAudit(?|SingleReport/([^/]++)(*:4839)|TrialReport/([^/]++)(*:4868))|ma(?|nagementReview(?|/([^/]++)(*:4909)|Report/([^/]++)(*:4933))|rketcomplaint/(?|mar(?|ket(?|complaint(?|_view/([^/]++)(*:4998)|update/([^/]++)(*:5022))|auditTrailPdf/([^/]++)(*:5054))|_comp_(?|stagechange/([^/]++)(*:5093)|reject_stateChange/([^/]++)(*:5129)))|Market(?|Complaint(?|Cancel/([^/]++)(*:5176)|AuditReport/([^/]++)(*:5205))|AuditReport/([^/]++)(*:5235))|auditDetailsMarket/([^/]++)(*:5272)))|DeviationAuditTrialPdf/([^/]++)(*:5314)|dev(?|show/([^/]++)(*:5342)|iation(?|update/([^/]++)(*:5375)|/(?|reject/([^/]++)(*:5403)|c(?|ancel/([^/]++)(*:5430)|ftnotreq(?|uired/([^/]++)(*:5464)|ired/([^/]++)(*:5486))|heck(?|/([^/]++)(*:5512)|2/([^/]++)(*:5531)|3/([^/]++)(*:5550)))|pending_initiator_update/([^/]++)(*:5594)|stage/([^/]++)(*:5617)|Qa/([^/]++)(*:5637))|SingleReport/([^/]++)(*:5668)))|launch\\-extension\\-(?|deviation/([^/]++)(*:5719)|capa/([^/]++)(*:5741)|qrm/([^/]++)(*:5762)|investigation/([^/]++)(*:5793))|thirdStage/([^/]++)(*:5822)|pdf\\-report/([^/]++)(*:5851)))|/notification/([^/]++)(*:5884)|/a(?|udit(?|Print/([^/]++)(*:5919)|\\-(?|trial/([^/]++)(*:5947)|individual/([^/]++)/([^/]++)(*:5984)|detail(?|/([^/]++)(*:6011)|s/([^/]++)(*:6030)))|Details(?|Capa/([^/]++)(*:6064)|risk/([^/]++)(*:6086)|Root/([^/]++)(*:6108)))|dmin/(?|d(?|epartment/([^/]++)(?|(*:6152)|/edit(*:6166)|(*:6175))|o(?|cument(?|_(?|subtypes/([^/]++)(?|(*:6222)|/edit(*:6236)|(*:6245))|types/([^/]++)(?|(*:6272)|/edit(*:6286)|(*:6295)))|language/([^/]++)(?|(*:6326)|/edit(*:6340)|(*:6349)))|wnloadcontrol/([^/]++)(?|(*:6385)|/edit(*:6399)|(*:6408)))|i(?|stributionlist/([^/]++)(?|(*:6449)|/edit(*:6463)|(*:6472))|vision/([^/]++)(?|(*:6500)|/edit(*:6514)|(*:6523))))|GroupPermission/([^/]++)(?|(*:6562)|/edit(*:6576)|(*:6585))|pr(?|o(?|cess/([^/]++)(?|(*:6620)|/edit(*:6634)|(*:6643))|duct/([^/]++)(?|(*:6669)|/edit(*:6683)|(*:6692)))|intcontrol/([^/]++)(?|(*:6725)|/edit(*:6739)|(*:6748)))|r(?|isk\\-level/([^/]++)(?|(*:6785)|/edit(*:6799)|(*:6808))|ole_groups/([^/]++)(?|(*:6840)|/edit(*:6854)|(*:6863)))|user_management/([^/]++)(?|(*:6901)|/edit(*:6915)|(*:6924))|material/([^/]++)(?|(*:6954)|/edit(*:6968)|(*:6977))|qms\\-(?|division/([^/]++)(?|(*:7015)|/edit(*:7029)|(*:7038))|process/([^/]++)(?|(*:7067)|/edit(*:7081)|(*:7090)))))|/update(?|\\-doc/([^/]++)(*:7127)|/([^/]++)(*:7145))|/TMS(?|/([^/]++)(?|(*:7174)|/edit(*:7188)|(*:7197))|\\-details/([^/]++)/([^/]++)(*:7234))|/t(?|raining(?|/([^/]++)(*:7268)|Question/([^/]++)(*:7294)|\\-(?|notification/([^/]++)(*:7329)|overall\\-status/([^/]++)(*:7362))|Complete/([^/]++)(*:7389))|ms\\-audit(?|/([^/]++)(*:7420)|\\-detail/([^/]++)(*:7446)))|/e(?|x(?|ample/([^/]++)(*:7480)|tension_(?|new(?|show/([^/]++)(*:7519)|/([^/]++)(*:7537))|send_stage/([^/]++)(*:7566)))|ffectiveness_check/([^/]++)(*:7604)|rrata(?|/(?|c(?|reate([^/]++)(*:7642)|ancel/([^/]++)(*:7665))|show/([^/]++)(*:7688)|update/([^/]++)(*:7712))|audittrail/([^/]++)(*:7741)|AuditInner/([^/]++)(*:7769)))|/qu(?|estion(?|/([^/]++)(?|(*:7807)|/edit(*:7821)|(*:7830))|data/([^/]++)(*:7853)|\\-bank/([^/]++)(?|(*:7880)|/edit(*:7894)|(*:7903)))|ize/([^/]++)(?|(*:7929)|/edit(*:7943)|(*:7952)))|/Ca(?|paAuditTrial/([^/]++)(*:7990)|ncelStateExternalAudit/([^/]++)(*:8030))|/manage(?|Update/([^/]++)(*:8065)|show/([^/]++)(*:8087)|/(?|stage/([^/]++)(*:8114)|cancel/([^/]++)(*:8138)|reject/([^/]++)(*:8162)|Qa/([^/]++)(*:8182)))|/ManagementReviewAudit(?|Trial/([^/]++)(*:8232)|Details/([^/]++)(*:8257))|/DeviationAuditTrial/([^/]++)(?|(*:8299))|/R(?|iskManagement/([^/]++)(*:8336)|ejectState(?|Auditee/([^/]++)(*:8374)|Change/([^/]++)(*:8398)))|/internalauditreject/([^/]++)(*:8438)|/InternalAuditC(?|ancel/([^/]++)(*:8479)|hild/([^/]++)(*:8501))|/ExternalAudit(?|StateChange/([^/]++)(*:8548)|Trial(?|Show/([^/]++)(*:8578)|Details/([^/]++)(*:8603)))|/StageChangeLabIncident/([^/]++)(*:8646)|/LabIncidentCancel/([^/]++)(*:8682))/?$}sDu',
    ),
    3 => 
    array (
      44 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.show',
          ),
          1 => 
          array (
            0 => 'change_control',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      56 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.edit',
          ),
          1 => 
          array (
            0 => 'change_control',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      63 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.update',
          ),
          1 => 
          array (
            0 => 'change_control',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'change-control.destroy',
          ),
          1 => 
          array (
            0 => 'change_control',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      90 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Gxyr76aZOJd8zNei',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rifHLCmjsmqxwNta',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      139 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'riskAssesmentChild',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      165 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'childexternalaudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      196 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capaUpdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      217 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capashow',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      243 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capa_send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      266 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capaCancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      289 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capa_reject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      308 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capa_qa_more_info',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      332 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capa_child_changecontrol',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      370 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division_change',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      407 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documents.show',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      420 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documents.edit',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      428 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documents.update',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'documents.destroy',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      457 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ycsXrzWqL78JuKHB',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      486 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0d505UaPTlAB4XlA',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      511 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gdfIELaWcyL4rEWC',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      535 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uXAhmD1i4a5OEztd',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      563 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.show',
          ),
          1 => 
          array (
            0 => 'documentsContent',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      576 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.edit',
          ),
          1 => 
          array (
            0 => 'documentsContent',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      584 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.update',
          ),
          1 => 
          array (
            0 => 'documentsContent',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'documentsContent.destroy',
          ),
          1 => 
          array (
            0 => 'documentsContent',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      612 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sUFStHqyIGVeLpIF',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      636 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'data',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      654 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'datag',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      686 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviation_child_1',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      729 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6HRATvBuI5l3MUiG',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      761 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qnfM3XnRqL6eTb3J',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      782 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showExternalAudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      812 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sop_training_users',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      848 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4XrhRoikfPdikdiE',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      874 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GwokH0nKwmoycbni',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      901 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reject_Risk',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      943 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'riskUpdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      970 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'riskAssesmentStateUpdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      997 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jb7f6gFwcZUKKWLF',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1027 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'root_update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1049 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'root_show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1076 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'root_send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1100 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'root_Cancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1124 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'root_reject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1153 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hIEI4iauSqexgPsi',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1184 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'CC.show',
          ),
          1 => 
          array (
            0 => 'CC',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1198 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'CC.edit',
          ),
          1 => 
          array (
            0 => 'CC',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1207 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'CC.update',
          ),
          1 => 
          array (
            0 => 'CC',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'CC.destroy',
          ),
          1 => 
          array (
            0 => 'CC',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1253 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x4mFMqtCq3JosbPh',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1274 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tDRZ7UppDuo4YJTS',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1296 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qvRO6B9N4c1MBkNk',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1333 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::81O426mD7csyYV1v',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1355 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rGRyVVTbFJeiTqWk',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1393 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZlMYpwRBrAt0mRyW',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1411 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RyzMhHrMJniV10f9',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1431 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WqvB2xs7uL1etecH',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1462 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Tva2jPnGwg8w5nXZ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1492 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TIOofo2zPbG9cIO4',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1531 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::p3tcu9pZNtp8ogUy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1559 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::z0EXV6D6vn9hxDeu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1580 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::V3sHnAqGhWhxbpRP',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1604 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZhFFWMpYcoVmDEno',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1629 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::d5E0LPo6rUzeKTNl',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1667 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.show',
          ),
          1 => 
          array (
            0 => 'actionItem',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1681 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.edit',
          ),
          1 => 
          array (
            0 => 'actionItem',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1690 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.update',
          ),
          1 => 
          array (
            0 => 'actionItem',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'actionItem.destroy',
          ),
          1 => 
          array (
            0 => 'actionItem',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1727 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HZADbboAoDSz7uKd',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1768 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showActionItemAuditTrial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1793 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showaudittrialactionItem',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1832 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionitemSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1861 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'actionitemAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1898 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KaG4pQDdmphS0NnJ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1922 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TwEnrpQBPg1HFdoK',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1941 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iWfXCZtYIC5FanLV',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1977 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'LabIncidentauditDetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2012 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auditProgramAuditTrialDetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2042 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auditProgramSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2071 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auditProgramAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2094 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ykrpAu3oorUM0Vxq',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2152 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_effective_AuditTrial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2177 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_audittrial_effective',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2208 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2237 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2265 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.show',
          ),
          1 => 
          array (
            0 => 'effectiveness',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2279 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.edit',
          ),
          1 => 
          array (
            0 => 'effectiveness',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2288 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.update',
          ),
          1 => 
          array (
            0 => 'effectiveness',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'effectiveness.destroy',
          ),
          1 => 
          array (
            0 => 'effectiveness',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2315 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uSopII540GHduZM9',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2352 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension_child',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2373 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension.show',
          ),
          1 => 
          array (
            0 => 'extension',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2387 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension.edit',
          ),
          1 => 
          array (
            0 => 'extension',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2396 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension.update',
          ),
          1 => 
          array (
            0 => 'extension',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'extension.destroy',
          ),
          1 => 
          array (
            0 => 'extension',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2432 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::179CvSpS1rcwzJBr',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2459 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::41STxgiKbofP6EMX',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2490 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extensionSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2519 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extensionAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2543 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qRacKfQNSMVQwWzs',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2579 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2603 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.stagereject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2631 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errataaudit.pdf',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2659 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xy6vicXjg4jQdHnJ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2694 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9qXUCP6UuX5MNXwG',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2729 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auditProgramChild',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2764 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'childmanagementReview',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2807 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jkCF6LoF8N9AAfuu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2840 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ccView',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2866 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::evi3N7FHqNGH5lBI',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2901 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capaSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2930 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capaAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2977 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ut1yirlfIlajSOU8',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'process',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3008 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vq7q3X4wuiIBNulA',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'process',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3047 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showInternalAudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3077 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'internalSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3106 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'internalauditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3134 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updateInternalAudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3163 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'LabIncidentUpdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3209 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'AuditStateChange',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3239 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ShowInternalAuditTrial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3264 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showaudittrialinternalaudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3305 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ShowLabIncident',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3336 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'StageChangeLabIncident',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3357 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'StageChangeLabtwo',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3387 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'LabIncidentSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3415 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'LabIncidentCancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3444 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lab_incident_capa_child',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3466 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lab_incident_root_child',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'audittrialLabincident',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3523 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'LabIncidentAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3568 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'RejectStateChange',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3586 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'RejectStateChangeObservation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3630 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'Child_root_cause_analysis',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3660 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rootSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3689 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rootAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3726 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'riskSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3755 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'riskAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3790 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auditdetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3813 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uvSXVoMvHlyRTTFN',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3854 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ShowAuditProgram',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3881 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showAuditProgramTrial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3905 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'AuditProgramCancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3935 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'StateChangeAuditProgram',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3970 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'AuditProgramStateRecject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4007 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'AuditProgramUpdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4046 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showobservation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4070 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'observationupdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4102 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'observation_change_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4125 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'observationchild',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4161 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rcms/oot_view',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EaXz7SCs2xDjJcIA',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4221 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4244 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ootStage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4276 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SvlhmEXjRI1F9bOo',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.oos_view',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4335 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.oosupdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4366 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4396 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.single_report',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4444 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.requestmoreinfo_back_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4472 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.reject_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4515 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.assignable_send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4547 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.audit_details',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4572 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.audit_report',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4607 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.cancel_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4633 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.capa_child_changecontrol',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4662 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.thirdStage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4690 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oos.audit_trial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4721 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updatestageobservation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4767 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ShowObservationAuditTrial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4792 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showaudittrialobservation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4839 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ExternalAuditSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4868 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ExternalAuditTrialReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4909 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'managementReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4933 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'managementReviewReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4998 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.marketcomplaint_view',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5022 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.marketcomplaintupdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5054 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.marketauditTrailPdf',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5093 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.mar_comp_stagechange',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5129 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.mar_comp_reject_stateChange',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5176 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.MarketComplaintCancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5205 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.MarketComplaintAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5235 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.marketAuditReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5272 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'marketcomplaint.marketauditDetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5314 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hzj82hsWVOqGDbKX',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5342 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'devshow',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviationupdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5403 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviation_reject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5430 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviationCancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5464 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviationIsCFTRequired',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5486 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cftnotreqired',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5512 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'check',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5531 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'check2',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5550 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'check3',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5594 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pending_initiator_update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5617 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviation_send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5637 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviation_qa_more_info',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5668 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deviationSingleReport',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5719 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'launch-extension-deviation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5741 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'launch-extension-capa',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5762 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'launch-extension-qrm',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5793 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'launch-extension-investigation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5822 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yZiVyUC6aP3Z8IyW',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5851 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::80FO4EdyCSsWTwcQ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5884 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gRUkT3BZYXuh59l9',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5919 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uzv5M4zx1VRbNpGr',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5947 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZKvomQD3J8Xz6aGs',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5984 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hEQPZe33n8zUz6Mw',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6011 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'audit-detail',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6030 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'audit-details',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6064 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showCapaAuditDetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6086 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showriskAuditDetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6108 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showrootAuditDetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6152 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'department.show',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6166 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'department.edit',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6175 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'department.update',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'department.destroy',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6222 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.show',
          ),
          1 => 
          array (
            0 => 'document_subtype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6236 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.edit',
          ),
          1 => 
          array (
            0 => 'document_subtype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6245 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.update',
          ),
          1 => 
          array (
            0 => 'document_subtype',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'document_subtypes.destroy',
          ),
          1 => 
          array (
            0 => 'document_subtype',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6272 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.show',
          ),
          1 => 
          array (
            0 => 'document_type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6286 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.edit',
          ),
          1 => 
          array (
            0 => 'document_type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6295 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.update',
          ),
          1 => 
          array (
            0 => 'document_type',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.destroy',
          ),
          1 => 
          array (
            0 => 'document_type',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6326 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.show',
          ),
          1 => 
          array (
            0 => 'documentlanguage',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6340 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.edit',
          ),
          1 => 
          array (
            0 => 'documentlanguage',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6349 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.update',
          ),
          1 => 
          array (
            0 => 'documentlanguage',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'documentlanguage.destroy',
          ),
          1 => 
          array (
            0 => 'documentlanguage',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6385 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.show',
          ),
          1 => 
          array (
            0 => 'downloadcontrol',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6399 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.edit',
          ),
          1 => 
          array (
            0 => 'downloadcontrol',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6408 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.update',
          ),
          1 => 
          array (
            0 => 'downloadcontrol',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'downloadcontrol.destroy',
          ),
          1 => 
          array (
            0 => 'downloadcontrol',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6449 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.show',
          ),
          1 => 
          array (
            0 => 'distributionlist',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6463 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.edit',
          ),
          1 => 
          array (
            0 => 'distributionlist',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6472 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.update',
          ),
          1 => 
          array (
            0 => 'distributionlist',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'distributionlist.destroy',
          ),
          1 => 
          array (
            0 => 'distributionlist',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6500 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division.show',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6514 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division.edit',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6523 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'division.update',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'division.destroy',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6562 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.show',
          ),
          1 => 
          array (
            0 => 'GroupPermission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6576 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.edit',
          ),
          1 => 
          array (
            0 => 'GroupPermission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6585 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.update',
          ),
          1 => 
          array (
            0 => 'GroupPermission',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'GroupPermission.destroy',
          ),
          1 => 
          array (
            0 => 'GroupPermission',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6620 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'process.show',
          ),
          1 => 
          array (
            0 => 'process',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6634 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'process.edit',
          ),
          1 => 
          array (
            0 => 'process',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6643 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'process.update',
          ),
          1 => 
          array (
            0 => 'process',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'process.destroy',
          ),
          1 => 
          array (
            0 => 'process',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6669 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.show',
          ),
          1 => 
          array (
            0 => 'product',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6683 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.edit',
          ),
          1 => 
          array (
            0 => 'product',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6692 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.update',
          ),
          1 => 
          array (
            0 => 'product',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'product.destroy',
          ),
          1 => 
          array (
            0 => 'product',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6725 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.show',
          ),
          1 => 
          array (
            0 => 'printcontrol',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6739 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.edit',
          ),
          1 => 
          array (
            0 => 'printcontrol',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6748 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.update',
          ),
          1 => 
          array (
            0 => 'printcontrol',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'printcontrol.destroy',
          ),
          1 => 
          array (
            0 => 'printcontrol',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6785 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.show',
          ),
          1 => 
          array (
            0 => 'risk_level',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6799 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.edit',
          ),
          1 => 
          array (
            0 => 'risk_level',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6808 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.update',
          ),
          1 => 
          array (
            0 => 'risk_level',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'risk-level.destroy',
          ),
          1 => 
          array (
            0 => 'risk_level',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6840 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.show',
          ),
          1 => 
          array (
            0 => 'role_group',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6854 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.edit',
          ),
          1 => 
          array (
            0 => 'role_group',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6863 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.update',
          ),
          1 => 
          array (
            0 => 'role_group',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'role_groups.destroy',
          ),
          1 => 
          array (
            0 => 'role_group',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6901 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.show',
          ),
          1 => 
          array (
            0 => 'user_management',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6915 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.edit',
          ),
          1 => 
          array (
            0 => 'user_management',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6924 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.update',
          ),
          1 => 
          array (
            0 => 'user_management',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'user_management.destroy',
          ),
          1 => 
          array (
            0 => 'user_management',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6954 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.show',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6968 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.edit',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6977 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.update',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'material.destroy',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7015 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.show',
          ),
          1 => 
          array (
            0 => 'qms_division',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7029 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.edit',
          ),
          1 => 
          array (
            0 => 'qms_division',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      7038 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.update',
          ),
          1 => 
          array (
            0 => 'qms_division',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'qms-division.destroy',
          ),
          1 => 
          array (
            0 => 'qms_division',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7067 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.show',
          ),
          1 => 
          array (
            0 => 'qms_process',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7081 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.edit',
          ),
          1 => 
          array (
            0 => 'qms_process',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      7090 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.update',
          ),
          1 => 
          array (
            0 => 'qms_process',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'qms-process.destroy',
          ),
          1 => 
          array (
            0 => 'qms_process',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update-doc',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7145 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updateExternalAudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7174 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.show',
          ),
          1 => 
          array (
            0 => 'TM',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7188 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.edit',
          ),
          1 => 
          array (
            0 => 'TM',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      7197 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.update',
          ),
          1 => 
          array (
            0 => 'TM',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'TMS.destroy',
          ),
          1 => 
          array (
            0 => 'TM',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7234 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ADVPFrdqsTGQ07X8',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'sopId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7268 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mWeHfmiCJ9EAFbd7',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7294 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DrGyOzlpnERXrpl1',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7329 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bVMPFY0Ss7OmsuKg',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7362 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::V7EuZsGlPZwtoGrf',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7389 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::smmgdIE6dwZI5icS',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7420 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qhMuPayezo7zbcNw',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7446 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::woKz4pP10aHusOW8',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7480 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IiSQqTlmihWBPaeN',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7519 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::loFdCEIGlhWxjrbA',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7537 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension_new.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7566 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'extension_send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7604 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'capa_effectiveness_check',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7642 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.create',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7665 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.cancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7688 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7712 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7741 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errata.audittrail',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7769 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'errataauditdetails',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7807 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question.show',
          ),
          1 => 
          array (
            0 => 'question',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7821 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question.edit',
          ),
          1 => 
          array (
            0 => 'question',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      7830 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question.update',
          ),
          1 => 
          array (
            0 => 'question',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'question.destroy',
          ),
          1 => 
          array (
            0 => 'question',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7853 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'questiondata',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7880 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.show',
          ),
          1 => 
          array (
            0 => 'question_bank',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7894 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.edit',
          ),
          1 => 
          array (
            0 => 'question_bank',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      7903 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.update',
          ),
          1 => 
          array (
            0 => 'question_bank',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'question-bank.destroy',
          ),
          1 => 
          array (
            0 => 'question_bank',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7929 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'quize.show',
          ),
          1 => 
          array (
            0 => 'quize',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7943 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'quize.edit',
          ),
          1 => 
          array (
            0 => 'quize',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      7952 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'quize.update',
          ),
          1 => 
          array (
            0 => 'quize',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'quize.destroy',
          ),
          1 => 
          array (
            0 => 'quize',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      7990 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::db5AzgoTH7vJ61zV',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8030 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'CancelStateExternalAudit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8065 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manageUpdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8087 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manageshow',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manage_send_stage',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8138 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manageCancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8162 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manage_reject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8182 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manage_qa_more_info',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8232 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mo0tIG18Gf7zuKpZ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8257 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BRY64MeHMzLEBr03',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8299 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jK6WPV2q5axiZY97',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'store_audit_review',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8336 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showRiskManagement',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8374 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'RejectStateAuditee',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8398 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::69iGciVb0dmaWrmF',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::m6OPqTs3kGHKzk5b',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8479 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fEqaXRcKVzEPIv9H',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8501 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'internal_audit_child',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8548 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'externalAuditStateChange',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8578 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ShowexternalAuditTrial',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8603 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ExternalAuditTrialDetailsShow',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8646 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kwXeRN2AGNLseyQg',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      8682 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dQSj6xxUfnyEIxz5',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Aajh7Xx2LQl7nxiB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/userLogin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@loginapi',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@loginapi',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Aajh7Xx2LQl7nxiB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Voc6zXQrDM4B7Ydf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/analyticsData',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@analyticsData',
        'controller' => 'App\\Http\\Controllers\\DashboardController@analyticsData',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Voc6zXQrDM4B7Ydf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Afdq4gH1CfIS2fAT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/dashboardStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\ApiController@dashboardStatus',
        'controller' => 'App\\Http\\Controllers\\ApiController@dashboardStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Afdq4gH1CfIS2fAT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::j9UlBvVaEszvj89v' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/getProfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\ApiController@getProfile',
        'controller' => 'App\\Http\\Controllers\\ApiController@getProfile',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::j9UlBvVaEszvj89v',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jILjI3Cc98sw8Wwa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/capaStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\ApiController@capaStatus',
        'controller' => 'App\\Http\\Controllers\\ApiController@capaStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::jILjI3Cc98sw8Wwa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'record.filter' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/filter-records',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@filterRecord',
        'controller' => 'App\\Http\\Controllers\\DocumentController@filterRecord',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'record.filter',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.upload.file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/upload-files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\HelperController@upload_file',
        'controller' => 'App\\Http\\Controllers\\Api\\HelperController@upload_file',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'api.upload.file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k4joFz2fXFSOzYBT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@userlogin',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@userlogin',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::k4joFz2fXFSOzYBT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@userlogin',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@userlogin',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lFX8NuzRPWTLLa9a' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logincheck',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@logincheck',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@logincheck',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::lFX8NuzRPWTLLa9a',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@logout',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oCHcITIJMoy6thhi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms_check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@rcmscheck',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@rcmscheck',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::oCHcITIJMoy6thhi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'error.route' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'error',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:262:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:44:"function () {
    return \\view(\'error\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000df40000000000000000";}";s:4:"hash";s:44:"rgL7HoFL8KeLLstEvRmzEwkLigjyOX7uvOio/NmPlAQ=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'error.route',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WPKltQYfYC7VGr2l' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::WPKltQYfYC7VGr2l',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forgot-password',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hL4lQeiRRYwj7a9h' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data-fields',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:277:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:59:"function () {
    return \\view(\'frontend.data-fields\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000e960000000000000000";}";s:4:"hash";s:44:"K07TD/7Gi5RtzgByI75sdjj8OECMyXLgIgxxtUZXkCo=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hL4lQeiRRYwj7a9h',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.index',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@index',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.create',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@create',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'change-control',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.store',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@store',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control/{change_control}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.show',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@show',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control/{change_control}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.edit',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@edit',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'change-control/{change_control}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.update',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@update',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-control.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'change-control/{change_control}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'change-control.destroy',
        'uses' => 'App\\Http\\Controllers\\OpenStageController@destroy',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Gxyr76aZOJd8zNei' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control-audit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\OpenStageController@auditTrial',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@auditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Gxyr76aZOJd8zNei',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rifHLCmjsmqxwNta' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control-audit-detail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\OpenStageController@auditDetails',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@auditDetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::rifHLCmjsmqxwNta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division_change' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'division/change/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\OpenStageController@division',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@division',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'division_change',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6HRATvBuI5l3MUiG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'send-notification/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\OpenStageController@notification',
        'controller' => 'App\\Http\\Controllers\\OpenStageController@notification',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6HRATvBuI5l3MUiG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.index',
        'uses' => 'App\\Http\\Controllers\\DocumentController@index',
        'controller' => 'App\\Http\\Controllers\\DocumentController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.create',
        'uses' => 'App\\Http\\Controllers\\DocumentController@create',
        'controller' => 'App\\Http\\Controllers\\DocumentController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'documents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.store',
        'uses' => 'App\\Http\\Controllers\\DocumentController@store',
        'controller' => 'App\\Http\\Controllers\\DocumentController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/{document}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.show',
        'uses' => 'App\\Http\\Controllers\\DocumentController@show',
        'controller' => 'App\\Http\\Controllers\\DocumentController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/{document}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.edit',
        'uses' => 'App\\Http\\Controllers\\DocumentController@edit',
        'controller' => 'App\\Http\\Controllers\\DocumentController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'documents/{document}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.update',
        'uses' => 'App\\Http\\Controllers\\DocumentController@update',
        'controller' => 'App\\Http\\Controllers\\DocumentController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documents.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'documents/{document}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documents.destroy',
        'uses' => 'App\\Http\\Controllers\\DocumentController@destroy',
        'controller' => 'App\\Http\\Controllers\\DocumentController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4XrhRoikfPdikdiE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'revision/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@revision',
        'controller' => 'App\\Http\\Controllers\\DocumentController@revision',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::4XrhRoikfPdikdiE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentExportPDF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentExportPDF',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@documentExportPDF',
        'controller' => 'App\\Http\\Controllers\\DocumentController@documentExportPDF',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'documentExportPDF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentExportEXCEL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentExportEXCEL',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@documentExportEXCEL',
        'controller' => 'App\\Http\\Controllers\\DocumentController@documentExportEXCEL',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'documentExportEXCEL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'csv.import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@import',
        'controller' => 'App\\Http\\Controllers\\DocumentController@import',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'csv.import',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bxnz09KJ0QiKHy9i' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'importpdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportController@PDFimport',
        'controller' => 'App\\Http\\Controllers\\ImportController@PDFimport',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::bxnz09KJ0QiKHy9i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division_submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'division_submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@division',
        'controller' => 'App\\Http\\Controllers\\DocumentController@division',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'division_submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dcrDivision_submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dcrDivision',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@dcrDivision',
        'controller' => 'App\\Http\\Controllers\\DocumentController@dcrDivision',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dcrDivision_submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ycsXrzWqL78JuKHB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/generatePdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@createPDF',
        'controller' => 'App\\Http\\Controllers\\DocumentController@createPDF',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ycsXrzWqL78JuKHB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0d505UaPTlAB4XlA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/reviseCreate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@revise_create',
        'controller' => 'App\\Http\\Controllers\\DocumentController@revise_create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0d505UaPTlAB4XlA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gdfIELaWcyL4rEWC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/printPDF/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@printPDF',
        'controller' => 'App\\Http\\Controllers\\DocumentController@printPDF',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::gdfIELaWcyL4rEWC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uXAhmD1i4a5OEztd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documents/viewpdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentController@viewPdf',
        'controller' => 'App\\Http\\Controllers\\DocumentController@viewPdf',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::uXAhmD1i4a5OEztd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentsContent',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.index',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@index',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentsContent/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.create',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@create',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'documentsContent',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.store',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@store',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentsContent/{documentsContent}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.show',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@show',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentsContent/{documentsContent}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.edit',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@edit',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'documentsContent/{documentsContent}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.update',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@update',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentsContent.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'documentsContent/{documentsContent}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'documentsContent.destroy',
        'uses' => 'App\\Http\\Controllers\\DocumentContentController@destroy',
        'controller' => 'App\\Http\\Controllers\\DocumentContentController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sUFStHqyIGVeLpIF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doc-details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@viewdetails',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@viewdetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::sUFStHqyIGVeLpIF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ALGuQPelkZHsgqge' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'sendforstagechanage',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@sendforstagechanage',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@sendforstagechanage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ALGuQPelkZHsgqge',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gRUkT3BZYXuh59l9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'notification/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@notification',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@notification',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::gRUkT3BZYXuh59l9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'get.data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@getData',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@getData',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'get.data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ENYIGRFJX0vdhuTv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@sendNotification',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@sendNotification',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ENYIGRFJX0vdhuTv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::va8hlKCDYHQhoLmk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@search',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@search',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::va8hlKCDYHQhoLmk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8UeSelznAfGbuVzL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'advanceSearch',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@searchAdvance',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@searchAdvance',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::8UeSelznAfGbuVzL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uzv5M4zx1VRbNpGr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auditPrint/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@printAudit',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@printAudit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::uzv5M4zx1VRbNpGr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::42zwBcyfKANx1AyD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'mytaskdata',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\MytaskController@index',
        'controller' => 'App\\Http\\Controllers\\MytaskController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::42zwBcyfKANx1AyD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cBRgYk8V8jznQeHz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'mydms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\CabinateController@index',
        'controller' => 'App\\Http\\Controllers\\CabinateController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cBRgYk8V8jznQeHz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8YBde93UaWpYwjDZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\CabinateController@email',
        'controller' => 'App\\Http\\Controllers\\CabinateController@email',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::8YBde93UaWpYwjDZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GwokH0nKwmoycbni' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rev-details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\MytaskController@reviewdetails',
        'controller' => 'App\\Http\\Controllers\\MytaskController@reviewdetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GwokH0nKwmoycbni',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qnfM3XnRqL6eTb3J' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send-change-control/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\ChangeControlController@statechange',
        'controller' => 'App\\Http\\Controllers\\ChangeControlController@statechange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::qnfM3XnRqL6eTb3J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZKvomQD3J8Xz6aGs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-trial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@auditTrial',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@auditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZKvomQD3J8Xz6aGs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hEQPZe33n8zUz6Mw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-individual/{id}/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@auditTrialIndividual',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@auditTrialIndividual',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hEQPZe33n8zUz6Mw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'audit-detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-detail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@auditDetails',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@auditDetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'audit-detail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'update-doc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update-doc/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@updatereviewers',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@updatereviewers',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'update-doc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'audit-details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentDetailsController@getAuditDetail',
        'controller' => 'App\\Http\\Controllers\\DocumentDetailsController@getAuditDetail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'audit-details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YNsTglkx7nrcCtbH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YNsTglkx7nrcCtbH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kqFF9cLjsYT8qW3F' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'analytics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@analytics',
        'controller' => 'App\\Http\\Controllers\\DashboardController@analytics',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kqFF9cLjsYT8qW3F',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cd9Nt5nuSO4fJB11' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'subscribe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@subscribe',
        'controller' => 'App\\Http\\Controllers\\DashboardController@subscribe',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cd9Nt5nuSO4fJB11',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'TMS',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.index',
        'uses' => 'App\\Http\\Controllers\\TMSController@index',
        'controller' => 'App\\Http\\Controllers\\TMSController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'TMS/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.create',
        'uses' => 'App\\Http\\Controllers\\TMSController@create',
        'controller' => 'App\\Http\\Controllers\\TMSController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'TMS',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.store',
        'uses' => 'App\\Http\\Controllers\\TMSController@store',
        'controller' => 'App\\Http\\Controllers\\TMSController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'TMS/{TM}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.show',
        'uses' => 'App\\Http\\Controllers\\TMSController@show',
        'controller' => 'App\\Http\\Controllers\\TMSController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'TMS/{TM}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.edit',
        'uses' => 'App\\Http\\Controllers\\TMSController@edit',
        'controller' => 'App\\Http\\Controllers\\TMSController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'TMS/{TM}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.update',
        'uses' => 'App\\Http\\Controllers\\TMSController@update',
        'controller' => 'App\\Http\\Controllers\\TMSController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'TMS.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'TMS/{TM}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'TMS.destroy',
        'uses' => 'App\\Http\\Controllers\\TMSController@destroy',
        'controller' => 'App\\Http\\Controllers\\TMSController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ADVPFrdqsTGQ07X8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'TMS-details/{id}/{sopId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@viewTraining',
        'controller' => 'App\\Http\\Controllers\\TMSController@viewTraining',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ADVPFrdqsTGQ07X8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mWeHfmiCJ9EAFbd7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'training/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@training',
        'controller' => 'App\\Http\\Controllers\\TMSController@training',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mWeHfmiCJ9EAFbd7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DrGyOzlpnERXrpl1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'trainingQuestion/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@trainingQuestion',
        'controller' => 'App\\Http\\Controllers\\TMSController@trainingQuestion',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::DrGyOzlpnERXrpl1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bVMPFY0Ss7OmsuKg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'training-notification/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@notification',
        'controller' => 'App\\Http\\Controllers\\TMSController@notification',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::bVMPFY0Ss7OmsuKg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::smmgdIE6dwZI5icS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'trainingComplete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@trainingStatus',
        'controller' => 'App\\Http\\Controllers\\TMSController@trainingStatus',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::smmgdIE6dwZI5icS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V7EuZsGlPZwtoGrf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'training-overall-status/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@trainingOverallStatus',
        'controller' => 'App\\Http\\Controllers\\TMSController@trainingOverallStatus',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::V7EuZsGlPZwtoGrf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qhMuPayezo7zbcNw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tms-audit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@auditTrial',
        'controller' => 'App\\Http\\Controllers\\TMSController@auditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::qhMuPayezo7zbcNw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::woKz4pP10aHusOW8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tms-audit-detail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@auditDetails',
        'controller' => 'App\\Http\\Controllers\\TMSController@auditDetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::woKz4pP10aHusOW8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IiSQqTlmihWBPaeN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'example/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\TMSController@example',
        'controller' => 'App\\Http\\Controllers\\TMSController@example',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IiSQqTlmihWBPaeN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.index',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@index',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.create',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@create',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'question',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.store',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@store',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question/{question}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.show',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@show',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question/{question}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.edit',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@edit',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'question/{question}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.update',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@update',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'question/{question}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question.destroy',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionController@destroy',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'questiondata' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'questiondata/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@datag',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@datag',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'questiondata',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question-bank',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.index',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@index',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question-bank/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.create',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@create',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'question-bank',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.store',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@store',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question-bank/{question_bank}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.show',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@show',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question-bank/{question_bank}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.edit',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@edit',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'question-bank/{question_bank}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.update',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@update',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'question-bank.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'question-bank/{question_bank}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'question-bank.destroy',
        'uses' => 'App\\Http\\Controllers\\tms\\QuestionBankController@destroy',
        'controller' => 'App\\Http\\Controllers\\tms\\QuestionBankController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'quize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.index',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@index',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'quize/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.create',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@create',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'quize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.store',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@store',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'quize/{quize}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.show',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@show',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'quize/{quize}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.edit',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@edit',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'quize/{quize}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.update',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@update',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'quize.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'quize/{quize}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'as' => 'quize.destroy',
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@destroy',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@datag',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@datag',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'datag' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'datag/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\tms\\QuizeController@data',
        'controller' => 'App\\Http\\Controllers\\tms\\QuizeController@data',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'datag',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QzSYkUIRuKYcjD4s' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'qms-dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'prevent-back-history',
          3 => 'user-activity',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RcmsDashboardController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\RcmsDashboardController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QzSYkUIRuKYcjD4s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ho2n3buhL2DTWPlE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'capa',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capa',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capa',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ho2n3buhL2DTWPlE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capastore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capastore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capastore',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capastore',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capastore',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capaUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capaUpdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capaUpdate',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capaUpdate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capaUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capashow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'capashow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capashow',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capashow',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capashow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capa_send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capa/stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capa_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capa_send_stage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capa_send_stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capaCancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capa/cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capaCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capaCancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capaCancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capa_reject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capa/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capa_reject',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capa_reject',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capa_reject',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capa_qa_more_info' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capa/Qa/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@capa_qa_more_info',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@capa_qa_more_info',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capa_qa_more_info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::db5AzgoTH7vJ61zV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'CapaAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@CapaAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@CapaAuditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::db5AzgoTH7vJ61zV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showCapaAuditDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auditDetailsCapa/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@auditDetailsCapa',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@auditDetailsCapa',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'showCapaAuditDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capa_child_changecontrol' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'capa_child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@child_change_control',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@child_change_control',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capa_child_changecontrol',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capa_effectiveness_check' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'effectiveness_check/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@effectiveness_check',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@effectiveness_check',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'capa_effectiveness_check',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'managestore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'managestore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@managestore',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@managestore',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'managestore',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manageUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manageUpdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manageUpdate',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manageUpdate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manageUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manageshow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manageshow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manageshow',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manageshow',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manageshow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manage_send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manage/stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manage_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manage_send_stage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manage_send_stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manageCancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manage/cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manageCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manageCancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manageCancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manage_reject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manage/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manage_reject',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manage_reject',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manage_reject',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manage_qa_more_info' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manage/Qa/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manage_qa_more_info',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@manage_qa_more_info',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manage_qa_more_info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mo0tIG18Gf7zuKpZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ManagementReviewAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@ManagementReviewAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@ManagementReviewAuditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mo0tIG18Gf7zuKpZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BRY64MeHMzLEBr03' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ManagementReviewAuditDetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@ManagementReviewAuditDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@ManagementReviewAuditDetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::BRY64MeHMzLEBr03',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviation_child_1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'deviation_child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_child_1',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_child_1',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'deviation_child_1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jK6WPV2q5axiZY97' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'DeviationAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@DeviationAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@DeviationAuditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jK6WPV2q5axiZY97',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store_audit_review' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'DeviationAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@store_audit_review',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@store_audit_review',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store_audit_review',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5zYx2P9BS24gIwlm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'risk-management',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@risk',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@risk',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5zYx2P9BS24gIwlm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showRiskManagement' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'RiskManagement/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@show',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'showRiskManagement',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk_store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'risk_store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@store',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'risk_store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'riskUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'riskAssesmentUpdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@riskUpdate',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@riskUpdate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'riskUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'riskAssesmentStateUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'riskAssesmentStateChange{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@riskAssesmentStateChange',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@riskAssesmentStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'riskAssesmentStateUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reject_Risk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reject_Risk/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@RejectStateChange',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@RejectStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'reject_Risk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jb7f6gFwcZUKKWLF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'riskAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@riskAuditTrial',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@riskAuditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jb7f6gFwcZUKKWLF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showriskAuditDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auditDetailsrisk/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@auditDetailsrisk',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@auditDetailsrisk',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'showriskAuditDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'riskAssesmentChild' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@child',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@child',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'riskAssesmentChild',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IEAzqbu2GLSlqGrD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'root-cause-analysis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@rootcause',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@rootcause',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IEAzqbu2GLSlqGrD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'root_store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rootstore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_store',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'root_store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'root_update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rootUpdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_update',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'root_update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'root_show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rootshow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_show',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'root_show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'root_send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'root/stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_send_stage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'root_send_stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'root_Cancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'root/cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_Cancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_Cancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'root_Cancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'root_reject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'root/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_reject',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@root_reject',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'root_reject',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hIEI4iauSqexgPsi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rootAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@rootAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@rootAuditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hIEI4iauSqexgPsi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showrootAuditDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auditDetailsRoot/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@auditDetailsroot',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@auditDetailsroot',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'showrootAuditDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::m6OPqTs3kGHKzk5b' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'internalauditreject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@RejectStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@RejectStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::m6OPqTs3kGHKzk5b',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fEqaXRcKVzEPIv9H' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'InternalAuditCancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditCancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fEqaXRcKVzEPIv9H',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'internal_audit_child' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'InternalAuditChild/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@internal_audit_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@internal_audit_child',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'internal_audit_child',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showExternalAudit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'showExternalAudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auditee_store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'auditee_store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'auditee_store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateExternalAudit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'updateExternalAudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'externalAuditStateChange' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ExternalAuditStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@ExternalAuditStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@ExternalAuditStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'externalAuditStateChange',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'RejectStateAuditee' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'RejectStateAuditee/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@RejectStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@RejectStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'RejectStateAuditee',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CancelStateExternalAudit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'CancelStateExternalAudit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@externalAuditCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@externalAuditCancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'CancelStateExternalAudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ShowexternalAuditTrial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ExternalAuditTrialShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@AuditTrialExternalShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@AuditTrialExternalShow',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ShowexternalAuditTrial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ExternalAuditTrialDetailsShow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ExternalAuditTrialDetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@AuditTrialExternalDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@AuditTrialExternalDetails',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ExternalAuditTrialDetailsShow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'childexternalaudit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'child_external/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@child_external',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@child_external',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'childexternalaudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::s7S8c1nxh8rviyhE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lab-incident',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@labincident',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@labincident',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::s7S8c1nxh8rviyhE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::69iGciVb0dmaWrmF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'RejectStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@RejectStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@RejectStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::69iGciVb0dmaWrmF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kwXeRN2AGNLseyQg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'StageChangeLabIncident/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentStateChange',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kwXeRN2AGNLseyQg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dQSj6xxUfnyEIxz5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'LabIncidentCancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentCancelStage',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentCancelStage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::dQSj6xxUfnyEIxz5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hIoskr2AENJliR0X' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@auditprogram',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@auditprogram',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hIoskr2AENJliR0X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zCJnHkV1gSC8oFXY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'emp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::zCJnHkV1gSC8oFXY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'emp',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QC48xf1a8wNSUd5S' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tasks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QC48xf1a8wNSUd5S',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.T',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZyJBAfYsT6FYTDq1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'review-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZyJBAfYsT6FYTDq1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.documents.review-details',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::atMtEj5563U81ED1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-trial-inner',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::atMtEj5563U81ED1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.documents.audit-trial-inner',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zLHAhn4nABWP0s7F' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'new-pdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::zLHAhn4nABWP0s7F',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.documents.new-pdf',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eFrbUvkPszW2BGPP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'new-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::eFrbUvkPszW2BGPP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.new-login',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5xjaN0zlsmmu4f4j' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'activity_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5xjaN0zlsmmu4f4j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.activity_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UPO4tlpTjj45gE0I' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'helpdesk-personnel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::UPO4tlpTjj45gE0I',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.helpdesk-personnel',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::P4WRJHtzhiAb7ShC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'designate-proxy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::P4WRJHtzhiAb7ShC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.designate-proxy',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::b1VqYBwSLn7XAj1T' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'person-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::b1VqYBwSLn7XAj1T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.person-details',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O87l8b4vKwV2DBGU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'basic-search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::O87l8b4vKwV2DBGU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.basic-search',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ACA78gHqhwIHnRTz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'create-training',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ACA78gHqhwIHnRTz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.create-training',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::j5iBpNKJK1lzrFTY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'example',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::j5iBpNKJK1lzrFTY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.example',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HsCsNqePrVaevzBy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'create-quiz',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::HsCsNqePrVaevzBy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.create-quiz',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QaOH19pWEMVvxxxc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'document-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QaOH19pWEMVvxxxc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.document-view',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZJXtSHi5DuLqTUqD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'training-page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZJXtSHi5DuLqTUqD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.training-page',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7Xj3JTz0uTYu43vk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'question-training',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7Xj3JTz0uTYu43vk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.question-training',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NVPKRMOLPQASBXrz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'edit-question',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NVPKRMOLPQASBXrz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.edit-question',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::T7zDNO4YvB5eNOAj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::T7zDNO4YvB5eNOAj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.change-control-list',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vic5JiqisUBMv7lo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control-list-print',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::vic5JiqisUBMv7lo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.change-control-list-print',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hmeeD5QykB6YfQQ2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hmeeD5QykB6YfQQ2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.change-control-view',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NyPtp9fgWbjOGCj1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reviewer-panel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NyPtp9fgWbjOGCj1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.reviewer-panel',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JYHZyenQ74MyyeTq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change-control-form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JYHZyenQ74MyyeTq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.data-fields',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gIDNsILe1ojIwOZi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'new-change-control',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@changecontrol',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@changecontrol',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::gIDNsILe1ojIwOZi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PyCpP61kwcdodCeU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-pdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::PyCpP61kwcdodCeU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.documents.audit-pdf',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'employee_new' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'employee_new',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'employee_new',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.Employee.employee_new',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'trainer_qualification' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'trainer_qualification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'trainer_qualification',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.TMS.Trainer_qualification.trainer_qualification',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::62UAMCn7fisVaziM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'chart-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DesktopController@fetchChartData',
        'controller' => 'App\\Http\\Controllers\\rcms\\DesktopController@fetchChartData',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::62UAMCn7fisVaziM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TaPtA5baYZxnrgAD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms_login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::TaPtA5baYZxnrgAD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.login',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cq3Z0uZkQcUhmFE9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms_dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cq3Z0uZkQcUhmFE9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.dashboard',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qWfhBtrHWbTeJMOF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms_desktop',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DesktopController@rcms_desktop',
        'controller' => 'App\\Http\\Controllers\\rcms\\DesktopController@rcms_desktop',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::qWfhBtrHWbTeJMOF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'main_dashboard_search' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard_search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DesktopController@main_dashboard_search',
        'controller' => 'App\\Http\\Controllers\\rcms\\DesktopController@main_dashboard_search',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'main_dashboard_search',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::csWyZeNSoxT3WanT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms_reports',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::csWyZeNSoxT3WanT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.reports',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::I8EbHLPUffkctJRO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Quality-Dashboard-Report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::I8EbHLPUffkctJRO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.Quality-Dashboard',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wMKEPqC9l5SC50V5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Supplier-Dashboard-Report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::wMKEPqC9l5SC50V5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.Supplier-Dashboard',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aYITVgLJw2WXAP8r' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'QMSDashboardFormat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::aYITVgLJw2WXAP8r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.QMSDashboardFormat',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ONDiANvIuaqg3aOy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'deviation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ONDiANvIuaqg3aOy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.deviation',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZjvNNOuvSPBG3Wi5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'extension_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZjvNNOuvSPBG3Wi5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.extension',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bWVJG35DhrUKB8ZW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cc-form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::bWVJG35DhrUKB8ZW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.change-control',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::78Qra3M89wmWIlEC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit-management',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::78Qra3M89wmWIlEC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.audit-management',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VgpcEQrOOLzM219C' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'out-of-specification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VgpcEQrOOLzM219C',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.out-of-specification',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jfHSYCkSD7PkU3Gv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'action-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jfHSYCkSD7PkU3Gv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.action-item',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QkBtCjZs3D6JYsdH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'effectiveness-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@effectiveness_check',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@effectiveness_check',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QkBtCjZs3D6JYsdH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V6Pe5uGpXb1Lhz0g' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'quality-event',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::V6Pe5uGpXb1Lhz0g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.quality-event',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x0tXoo48OVYqEq4P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'vendor-entity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::x0tXoo48OVYqEq4P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.vendor-entity',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PbE2pTazjq1kbgiE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auditee',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@external_audit',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@external_audit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::PbE2pTazjq1kbgiE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FIzHip8cdoEQfwvD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'meeting',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@meeting',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@meeting',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FIzHip8cdoEQfwvD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FQ2tZ1o0sj19aPt5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'classroom-training',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FQ2tZ1o0sj19aPt5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.classroom-training',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i4Xm5EcAsrYesoUc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'employee',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::i4Xm5EcAsrYesoUc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.employee',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::A4pKeyLOfgWZmFyA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'requirement-template',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::A4pKeyLOfgWZmFyA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.requirement-template',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zFVWlj24Bo6swdDU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'scar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::zFVWlj24Bo6swdDU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.scar',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3sYhAyOMjxbJkkS6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'external-audit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3sYhAyOMjxbJkkS6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.external-audit',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LWbRputxTHkuAPnq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contract',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::LWbRputxTHkuAPnq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.contract',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IJerLXqisGXQWr8G' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IJerLXqisGXQWr8G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tKnKyMHKT4rFp9Gi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier-initiated-change',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::tKnKyMHKT4rFp9Gi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier-initiated-change',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::L5apdGL4wlS5m9DJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier-investigation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::L5apdGL4wlS5m9DJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier-investigation',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WKWOBmlR8BgJveDG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier-issue-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::WKWOBmlR8BgJveDG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier-issue-notification',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ujKuJlKNhhmHMv9f' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier-audit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ujKuJlKNhhmHMv9f',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier-audit',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lsz5m4vDcmFFJWtj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'audit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@internal_audit',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@internal_audit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::lsz5m4vDcmFFJWtj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jEk4NkaRPF6EMrS2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier-questionnaire',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jEk4NkaRPF6EMrS2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier-questionnaire',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::huGvY9Gs0hfepHCp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'substance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::huGvY9Gs0hfepHCp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.substance',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YHYllsfr7F6JIYTS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'supplier-action-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YHYllsfr7F6JIYTS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.supplier-action-item',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::D7F5ZQoK799hfQrw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'registration-template',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::D7F5ZQoK799hfQrw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.registration-template',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1RodCiqAu8IMRA2p' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'project',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::1RodCiqAu8IMRA2p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.project',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jmQsdnKGQNvZY31N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'extension',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extension_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extension_child',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jmQsdnKGQNvZY31N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7bS3prf6Y3JSZsa4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'observation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@observation',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@observation',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7bS3prf6Y3JSZsa4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fvZciUQ2MfCIW2Vx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'new-root-cause-analysis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fvZciUQ2MfCIW2Vx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.new-root-cause-analysis',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::c2GuIkpTYmPZmNR5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'help-desk-incident',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::c2GuIkpTYmPZmNR5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.help-desk-incident',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6aiIGA49JMWaIL1P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'review-management-report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6aiIGA49JMWaIL1P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.review-management.review-management-report',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CnCdyzCB44wVVzVl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'OOT_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::CnCdyzCB44wVVzVl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.OOT.OOT_form',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ooc.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'out_of_calibration',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOCController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOCController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ooc.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ooc.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'OOC/view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOCController@edit',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOCController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ooc.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oocCreate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ooccreate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOCController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOCController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'oocCreate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JHTfLXyOYlxqY8gk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'out_of_calibration_ooc',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOCController@ooc',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOCController@ooc',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JHTfLXyOYlxqY8gk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos_micro.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oos_micro',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\OOSMicroController@index',
        'controller' => 'App\\Http\\Controllers\\OOSMicroController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'oos_micro.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OVChnifAn8n8KjtL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oos_oot_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OVChnifAn8n8KjtL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.OOS\\OOT.oos_oot',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dAprGEmuLMTNMYmG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'change_control_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::dAprGEmuLMTNMYmG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.changeControlLog',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JUY0vtIHb3TZVxWv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'market_complaint_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JUY0vtIHb3TZVxWv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.Market-Complaint-registerLog',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MIbcKpn2uyO1DQlV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'incident_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::MIbcKpn2uyO1DQlV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.incidentLog',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7LAdumjDMD3UyVc4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'risk_management_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7LAdumjDMD3UyVc4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.riskmanagementLog',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q1rZAX8OugSt0MSV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'errata_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Q1rZAX8OugSt0MSV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.errata_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SUy4i8eXuWU6di9U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'laboratory_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::SUy4i8eXuWU6di9U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.laboratoryIncidentLog',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bDTxyfa37o0Wczxj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'capa_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::bDTxyfa37o0Wczxj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.capa_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OTm1c3TfwrASaaG4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'non_conformance_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OTm1c3TfwrASaaG4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.non_conformance_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pUp7tjK0SBrs7nJQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'deviation_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::pUp7tjK0SBrs7nJQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.deviation_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::41RqO37YrHmsyY4x' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'OOC_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::41RqO37YrHmsyY4x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.OOC_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3Ygl6wENY591E675' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'OOS_OOT_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3Ygl6wENY591E675',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.OOS_OOT_log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yNCF39MwpwfJglhC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Failure_invst_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::yNCF39MwpwfJglhC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.Failure_investigation_Log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YSnuHlABboqviMA3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'internal_audit_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YSnuHlABboqviMA3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.Logs.Internal_audit_Log',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sop_training_users' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sop/users/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Ajax\\AjaxController@getSopTrainingUsers',
        'controller' => 'App\\Http\\Controllers\\Ajax\\AjaxController@getSopTrainingUsers',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'sop_training_users',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata_new' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'errata_new',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata_new',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.errata.errata_new',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5SlZwQN1rr9ZV5KN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'errata_view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5SlZwQN1rr9ZV5KN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.errata.errata_view',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'employee.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tms/employee',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\tms\\EmployeeController@store',
        'controller' => 'App\\Http\\Controllers\\tms\\EmployeeController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'employee.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'trainer.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tms/trainer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\tms\\TrainerController@store',
        'controller' => 'App\\Http\\Controllers\\tms\\TrainerController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'trainer.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.create' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'errata/create{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@create',
        'controller' => 'App\\Http\\Controllers\\ErrataController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'errata/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@store',
        'controller' => 'App\\Http\\Controllers\\ErrataController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'errata/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@show',
        'controller' => 'App\\Http\\Controllers\\ErrataController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'errata/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@update',
        'controller' => 'App\\Http\\Controllers\\ErrataController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.audittrail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'errataaudittrail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@AuditTrial',
        'controller' => 'App\\Http\\Controllers\\ErrataController@AuditTrial',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata.audittrail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errataauditdetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'errataAuditInner/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@auditDetailsErrata',
        'controller' => 'App\\Http\\Controllers\\ErrataController@auditDetailsErrata',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errataauditdetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'errata/cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@erratacancelstage',
        'controller' => 'App\\Http\\Controllers\\ErrataController@erratacancelstage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'errata.cancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jqaVLNzxJjzLd6DD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'extension-new',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ExtensionNewController@index',
        'controller' => 'App\\Http\\Controllers\\ExtensionNewController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jqaVLNzxJjzLd6DD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension_new.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'extension_new',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ExtensionNewController@store',
        'controller' => 'App\\Http\\Controllers\\ExtensionNewController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'extension_new.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::loFdCEIGlhWxjrbA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'extension_newshow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ExtensionNewController@show',
        'controller' => 'App\\Http\\Controllers\\ExtensionNewController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::loFdCEIGlhWxjrbA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension_new.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'extension_new/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ExtensionNewController@update',
        'controller' => 'App\\Http\\Controllers\\ExtensionNewController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'extension_new.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension_send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'extension_send_stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ExtensionNewController@sendstage',
        'controller' => 'App\\Http\\Controllers\\ExtensionNewController@sendstage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'extension_send_stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yX3aVjm6HS3u3ASw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::yX3aVjm6HS3u3ASw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'admin.auth.login',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fOiTdUwUOrxvIxGl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\admin\\LoginController@login',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::fOiTdUwUOrxvIxGl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z3lsoJTrrocyRSrY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\admin\\LoginController@logout',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::Z3lsoJTrrocyRSrY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QzFure4LxMIFuNZ5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\DashboardController@dashboard',
        'controller' => 'App\\Http\\Controllers\\admin\\DashboardController@dashboard',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::QzFure4LxMIFuNZ5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/department',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/department/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/department',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/department/{department}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/department/{department}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/department/{department}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'department.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/department/{department}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'department.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DepartmentController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DepartmentController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_subtypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_subtypes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/document_subtypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_subtypes/{document_subtype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_subtypes/{document_subtype}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/document_subtypes/{document_subtype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_subtypes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/document_subtypes/{document_subtype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_subtypes.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DocSubtypeController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_types',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_types/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/document_types',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_types/{document_type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/document_types/{document_type}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/document_types/{document_type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'document_types.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/document_types/{document_type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'document_types.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentTypeController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/documentlanguage',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/documentlanguage/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/documentlanguage',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/documentlanguage/{documentlanguage}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/documentlanguage/{documentlanguage}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/documentlanguage/{documentlanguage}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'documentlanguage.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/documentlanguage/{documentlanguage}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'documentlanguage.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DocumentlanguageController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/distributionlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/distributionlist/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/distributionlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/distributionlist/{distributionlist}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/distributionlist/{distributionlist}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/distributionlist/{distributionlist}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distributionlist.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/distributionlist/{distributionlist}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'distributionlist.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DistributionListController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DistributionListController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/GroupPermission',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.index',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/GroupPermission/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.create',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/GroupPermission',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.store',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/GroupPermission/{GroupPermission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.show',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/GroupPermission/{GroupPermission}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/GroupPermission/{GroupPermission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.update',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'GroupPermission.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/GroupPermission/{GroupPermission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'GroupPermission.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\GroupPermissionController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/division',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/division/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/division',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/division/{division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/division/{division}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/division/{division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'division.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/division/{division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'division.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DivisionController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DivisionController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.index',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/process/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.create',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.store',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/process/{process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.show',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/process/{process}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/process/{process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.update',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'process.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/process/{process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'process.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\ProcessController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\ProcessController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/risk-level',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.index',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/risk-level/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.create',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/risk-level',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.store',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/risk-level/{risk_level}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.show',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/risk-level/{risk_level}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/risk-level/{risk_level}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.update',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'risk-level.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/risk-level/{risk_level}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'risk-level.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\RiskLevelController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\RiskLevelController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user_management',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.index',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user_management/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.create',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/user_management',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.store',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user_management/{user_management}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.show',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/user_management/{user_management}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/user_management/{user_management}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.update',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user_management.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/user_management/{user_management}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'user_management.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\UserManagementController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\UserManagementController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/role_groups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.index',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/role_groups/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.create',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/role_groups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.store',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/role_groups/{role_group}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.show',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/role_groups/{role_group}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/role_groups/{role_group}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.update',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role_groups.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/role_groups/{role_group}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'role_groups.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\RoleGroupController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\RoleGroupController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/printcontrol',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.index',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/printcontrol/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.create',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/printcontrol',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.store',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/printcontrol/{printcontrol}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.show',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/printcontrol/{printcontrol}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/printcontrol/{printcontrol}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.update',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printcontrol.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/printcontrol/{printcontrol}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'printcontrol.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\PrintControlController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\PrintControlController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/downloadcontrol',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.index',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/downloadcontrol/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.create',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/downloadcontrol',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.store',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/downloadcontrol/{downloadcontrol}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.show',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/downloadcontrol/{downloadcontrol}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/downloadcontrol/{downloadcontrol}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.update',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'downloadcontrol.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/downloadcontrol/{downloadcontrol}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'downloadcontrol.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\DownloadControlController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\DownloadControlController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.index',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.create',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.store',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/{product}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.show',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/product/{product}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/product/{product}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.update',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/product/{product}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'product.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\ProductController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\ProductController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.index',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.create',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/material',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.store',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material/{material}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.show',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/material/{material}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/material/{material}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.update',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/material/{material}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'material.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\MaterialController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\MaterialController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-division',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.index',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-division/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.create',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/qms-division',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.store',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-division/{qms_division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.show',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-division/{qms_division}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/qms-division/{qms_division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.update',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-division.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/qms-division/{qms_division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-division.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSDivisionController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.index',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-process/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.create',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/qms-process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.store',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-process/{qms_process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.show',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/qms-process/{qms_process}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/qms-process/{qms_process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.update',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms-process.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/qms-process/{qms_process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'as' => 'qms-process.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\QMSProcessController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\QMSProcessController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KGgpJSB0R0LOxKFe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/rcms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::KGgpJSB0R0LOxKFe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.main-screen',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Qras2DKrIp4Y0gwE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/rcms_login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@userlogin',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@userlogin',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::Qras2DKrIp4Y0gwE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GAYNjiK55yMgnmSN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/rcms_dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::GAYNjiK55yMgnmSN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.dashboard',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9BJXYSXWOTvseGjd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/form-division',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::9BJXYSXWOTvseGjd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.forms.form-division',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rcms.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserLoginController@rcmslogout',
        'controller' => 'App\\Http\\Controllers\\UserLoginController@rcmslogout',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'rcms.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/CC',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.index',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@index',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/CC/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.create',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/CC',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.store',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@store',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/CC/{CC}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.show',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@show',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/CC/{CC}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.edit',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@edit',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@edit',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'rcms/CC/{CC}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.update',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'CC.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'rcms/CC/{CC}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'CC.destroy',
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@destroy',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@destroy',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x4mFMqtCq3JosbPh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-initiator/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@sendToInitiator',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@sendToInitiator',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::x4mFMqtCq3JosbPh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qvRO6B9N4c1MBkNk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-hod/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@sendToHod',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@sendToHod',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::qvRO6B9N4c1MBkNk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tDRZ7UppDuo4YJTS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-initialQA/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@sendToInitialQA',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@sendToInitialQA',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::tDRZ7UppDuo4YJTS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::81O426mD7csyYV1v' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-cft-from-QA/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@sendToCft',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@sendToCft',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::81O426mD7csyYV1v',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/actionItem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.index',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@index',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/actionItem/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.create',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/actionItem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.store',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@store',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/actionItem/{actionItem}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.show',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@show',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/actionItem/{actionItem}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.edit',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@edit',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@edit',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'rcms/actionItem/{actionItem}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.update',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionItem.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'rcms/actionItem/{actionItem}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'actionItem.destroy',
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@destroy',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@destroy',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HZADbboAoDSz7uKd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/action-stage-cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@actionStageCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@actionStageCancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::HZADbboAoDSz7uKd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showActionItemAuditTrial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/action-item-audittrialshow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@actionItemAuditTrialShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@actionItemAuditTrialShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showActionItemAuditTrial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showaudittrialactionItem' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/action-item-audittrialdetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@actionItemAuditTrialDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@actionItemAuditTrialDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showaudittrialactionItem',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionitemSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/actionitemSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'actionitemSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'actionitemAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/actionitemAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'actionitemAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_effective_AuditTrial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effective-audit-trial-show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@effectiveAuditTrialShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@effectiveAuditTrialShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'show_effective_AuditTrial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_audittrial_effective' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effective-audit-trial-details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@effectiveAuditTrialDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@effectiveAuditTrialDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'show_audittrial_effective',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effectiveSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'effectiveSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effectiveAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'effectiveAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension_child' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/extension_child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extension_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extension_child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'extension_child',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extension',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.index',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@index',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extension/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.create',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/extension',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.store',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@store',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extension/{extension}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.show',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@show',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extension/{extension}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.edit',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@edit',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@edit',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'rcms/extension/{extension}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.update',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extension.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'rcms/extension/{extension}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'extension.destroy',
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@destroy',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@destroy',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Tva2jPnGwg8w5nXZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-extension/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@stageChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@stageChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::Tva2jPnGwg8w5nXZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p3tcu9pZNtp8ogUy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-reject-extention/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@stagereject',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@stagereject',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::p3tcu9pZNtp8ogUy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZlMYpwRBrAt0mRyW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-cancel-extention/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@stagecancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@stagecancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::ZlMYpwRBrAt0mRyW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::179CvSpS1rcwzJBr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extension-audit-trial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extensionAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extensionAuditTrial',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::179CvSpS1rcwzJBr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::41STxgiKbofP6EMX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extension-audit-trial-details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extensionAuditTrialDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@extensionAuditTrialDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::41STxgiKbofP6EMX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extensionSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extensionSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'extensionSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'extensionAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/extensionAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ExtensionController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\ExtensionController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'extensionAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V3sHnAqGhWhxbpRP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-At/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ActionItemController@stageChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\ActionItemController@stageChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::V3sHnAqGhWhxbpRP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::z0EXV6D6vn9hxDeu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-rejection-field/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@stagereject',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@stagereject',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::z0EXV6D6vn9hxDeu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rGRyVVTbFJeiTqWk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-cft-field/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@stageCFTnotReq',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@stageCFTnotReq',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::rGRyVVTbFJeiTqWk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RyzMhHrMJniV10f9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@stagecancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@stagecancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::RyzMhHrMJniV10f9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WqvB2xs7uL1etecH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-cc/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@stageChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@stageChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::WqvB2xs7uL1etecH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9qXUCP6UuX5MNXwG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@child',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::9qXUCP6UuX5MNXwG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'qms.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/qms-dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'qms.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ut1yirlfIlajSOU8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/qms-dashboard/{id}/{process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DashboardController@dashboard_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\DashboardController@dashboard_child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::Ut1yirlfIlajSOU8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vq7q3X4wuiIBNulA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/qms-dashboard_new/{id}/{process}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DashboardController@dashboard_child_new',
        'controller' => 'App\\Http\\Controllers\\rcms\\DashboardController@dashboard_child_new',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::vq7q3X4wuiIBNulA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KaG4pQDdmphS0NnJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/audit-trial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@auditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@auditTrial',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::KaG4pQDdmphS0NnJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TwEnrpQBPg1HFdoK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/audit-detail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@auditDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@auditDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::TwEnrpQBPg1HFdoK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::d5E0LPo6rUzeKTNl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/summary/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@summery_pdf',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@summery_pdf',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::d5E0LPo6rUzeKTNl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iWfXCZtYIC5FanLV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/audit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@audit_pdf',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@audit_pdf',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::iWfXCZtYIC5FanLV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ccView' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/ccView/{id}/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DashboardController@ccView',
        'controller' => 'App\\Http\\Controllers\\rcms\\DashboardController@ccView',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ccView',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dV8ZGHsyGGBd6vSV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/summary_pdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::dV8ZGHsyGGBd6vSV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.summary_pdf',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mO2tOpotFaCDca6O' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/audit_trial_pdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::mO2tOpotFaCDca6O',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.audit_trial_pdf',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sY1Tg3lxxtza4WfB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/change_control_single_pdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::sY1Tg3lxxtza4WfB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.change-control.change_control_single_pdf',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gUrcdkBvA6MA6Jxq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/change_control_family_pdf',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@parent_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@parent_child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::gUrcdkBvA6MA6Jxq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jkCF6LoF8N9AAfuu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/change_control_single_pdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@single_pdf',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@single_pdf',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::jkCF6LoF8N9AAfuu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qRacKfQNSMVQwWzs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/eCheck/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@eCheck',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@eCheck',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::qRacKfQNSMVQwWzs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effectiveness',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.index',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@index',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effectiveness/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.create',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/effectiveness',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.store',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@store',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effectiveness/{effectiveness}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.show',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@show',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/effectiveness/{effectiveness}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.edit',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@edit',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@edit',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'rcms/effectiveness/{effectiveness}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.update',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'effectiveness.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'rcms/effectiveness/{effectiveness}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'as' => 'effectiveness.destroy',
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@destroy',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@destroy',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TIOofo2zPbG9cIO4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/send-effectiveness/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@stageChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@stageChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::TIOofo2zPbG9cIO4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uSopII540GHduZM9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/effectiveness-reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@reject',
        'controller' => 'App\\Http\\Controllers\\rcms\\EffectivenessCheckController@reject',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::uSopII540GHduZM9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::evi3N7FHqNGH5lBI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@ootCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@ootCancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::evi3N7FHqNGH5lBI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3uGjJE2OPkNVuB4i' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/helpdesk-personnel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::3uGjJE2OPkNVuB4i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.helpdesk-personnel',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vgHxR3FtppDq5SUC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/send-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::vgHxR3FtppDq5SUC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'frontend.rcms.send-notification',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZvTgz6M2ot1gPJxQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/new-change-control',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CCController@changecontrol',
        'controller' => 'App\\Http\\Controllers\\rcms\\CCController@changecontrol',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::ZvTgz6M2ot1gPJxQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'createInternalAudit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/audit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'createInternalAudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showInternalAudit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/internalAuditShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@internalAuditShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@internalAuditShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showInternalAudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateInternalAudit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'updateInternalAudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'AuditStateChange' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/InternalAuditStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditStateChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'AuditStateChange',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ShowInternalAuditTrial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/InternalAuditTrialShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditTrialShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditTrialShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ShowInternalAuditTrial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showaudittrialinternalaudit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/InternalAuditTrialDetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditTrialDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@InternalAuditTrialDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showaudittrialinternalaudit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'labIncidentCreate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/labcreate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'labIncidentCreate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ShowLabIncident' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/LabIncidentShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ShowLabIncident',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'StageChangeLabIncident' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/LabIncidentStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentStateChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'StageChangeLabIncident',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'StageChangeLabtwo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/LabIncidentStateTwo/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentStateTwo',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentStateTwo',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'StageChangeLabtwo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'RejectStateChange' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/RejectStateChangeEsign/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@RejectStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@RejectStateChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'RejectStateChange',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'LabIncidentUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/updateLabIncident/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@updateLabIncident',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@updateLabIncident',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'LabIncidentUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'LabIncidentCancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/LabIncidentCancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentCancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'LabIncidentCancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lab_incident_capa_child' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/LabIncidentChildCapa/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@lab_incident_capa_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@lab_incident_capa_child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'lab_incident_capa_child',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lab_incident_root_child' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/LabIncidentChildRoot/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@lab_incident_root_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@lab_incident_root_child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'lab_incident_root_child',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'audittrialLabincident' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/LabIncidentAuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@LabIncidentAuditTrial',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'audittrialLabincident',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'LabIncidentauditDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/auditDetailsLabIncident/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@auditDetailsLabIncident',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@auditDetailsLabIncident',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'LabIncidentauditDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'Child_root_cause_analysis' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/root_cause_analysis/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@root_cause_analysis',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@root_cause_analysis',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'Child_root_cause_analysis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'LabIncidentSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/LabIncidentSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'LabIncidentSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'LabIncidentAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/LabIncidentAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\LabIncidentController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'LabIncidentAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'createAuditProgram' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@create',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@create',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'createAuditProgram',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ShowAuditProgram' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/AuditProgramShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditProgramShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditProgramShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ShowAuditProgram',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'StateChangeAuditProgram' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/AuditStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditStateChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'StateChangeAuditProgram',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'AuditProgramStateRecject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/AuditRejectStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditRejectStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditRejectStateChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'AuditProgramStateRecject',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'AuditProgramUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/UpdateAuditProgram/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@UpdateAuditProgram',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@UpdateAuditProgram',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'AuditProgramUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showAuditProgramTrial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/AuditProgramTrialShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditProgramTrialShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditProgramTrialShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showAuditProgramTrial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auditProgramAuditTrialDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/auditProgramDetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@auditProgramDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@auditProgramDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'auditProgramAuditTrialDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auditProgramChild' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/child_audit_program/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@child_audit_program',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@child_audit_program',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'auditProgramChild',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'AuditProgramCancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/AuditProgramCancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditProgramCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@AuditProgramCancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'AuditProgramCancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auditProgramSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/auditProgramSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'auditProgramSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auditProgramAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/auditProgramAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditProgramController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'auditProgramAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showobservation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/observationshow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@observationshow',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@observationshow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showobservation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'observationstore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/observationstore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@observationstore',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@observationstore',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'observationstore',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'observationupdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/observationupdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@observationupdate',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@observationupdate',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'observationupdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'observation_change_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/observation_send_stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@observation_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@observation_send_stage',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'observation_change_stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'RejectStateChangeObservation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/RejectStateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@RejectStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@RejectStateChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'RejectStateChangeObservation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'observationchild' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/observation_child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@observation_child',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@observation_child',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'observationchild',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updatestageobservation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/boostStage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@boostStage',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@boostStage',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'updatestageobservation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ShowObservationAuditTrial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/ObservationAuditTrialShow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@ObservationAuditTrialShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@ObservationAuditTrialShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ShowObservationAuditTrial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showaudittrialobservation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/ObservationAuditTrialDetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ObservationController@ObservationAuditTrialDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\ObservationController@ObservationAuditTrialDetails',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'showaudittrialobservation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'formDivision' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/formDivision',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\FormDivisionController@formDivision',
        'controller' => 'App\\Http\\Controllers\\rcms\\FormDivisionController@formDivision',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'formDivision',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ExternalAuditSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/ExternalAuditSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ExternalAuditSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ExternalAuditTrialReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/ExternalAuditTrialReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\AuditeeController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\AuditeeController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ExternalAuditTrialReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capaSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/capaSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'capaSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'capaAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/capaAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'capaAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'riskSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/riskSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@singleReport',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'riskSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'riskAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/riskAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\RiskManagementController@auditReport',
        'controller' => 'App\\Http\\Controllers\\RiskManagementController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'riskAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rootSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/rootSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'rootSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rootAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/rootAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\RootCauseController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\RootCauseController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'rootAuditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'managementReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/managementReview/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@managementReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@managementReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'managementReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'managementReviewReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/managementReviewReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@managementReviewReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@managementReviewReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'managementReviewReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'childmanagementReview' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/child_management_Review/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@child_management_Review',
        'controller' => 'App\\Http\\Controllers\\rcms\\ManagementReviewController@child_management_Review',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'childmanagementReview',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'internalSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/internalSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'internalSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'internalauditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/internalauditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\InternalauditController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\InternalauditController@auditReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'internalauditReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/errata/stages/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@stageChange',
        'controller' => 'App\\Http\\Controllers\\ErrataController@stageChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'errata.stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errata.stagereject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/errata/stagesreject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@stageReject',
        'controller' => 'App\\Http\\Controllers\\ErrataController@stageReject',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'errata.stagereject',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'errataaudit.pdf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/errata_audit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@auditTrailPdf',
        'controller' => 'App\\Http\\Controllers\\ErrataController@auditTrailPdf',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'errataaudit.pdf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xy6vicXjg4jQdHnJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/errata_single_pdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\ErrataController@singleReports',
        'controller' => 'App\\Http\\Controllers\\ErrataController@singleReports',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::xy6vicXjg4jQdHnJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/deviation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hzj82hsWVOqGDbKX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/DeviationAuditTrialPdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviationAuditTrailPdf',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviationAuditTrailPdf',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::hzj82hsWVOqGDbKX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviationstore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviationstore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@store',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviationstore',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'devshow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/devshow/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@devshow',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@devshow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'devshow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviationupdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviationupdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviationupdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviation_reject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_reject',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_reject',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviation_reject',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviationCancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviationCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviationCancel',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviationCancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviationIsCFTRequired' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/cftnotrequired/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviationIsCFTRequired',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviationIsCFTRequired',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviationIsCFTRequired',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'check' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/check/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@check',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@check',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'check',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'check2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/check2/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@check2',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@check2',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'check2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'check3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/check3/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@check3',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@check3',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'check3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pending_initiator_update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/pending_initiator_update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@pending_initiator_update',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@pending_initiator_update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'pending_initiator_update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviation_send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_send_stage',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviation_send_stage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cftnotreqired' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/cftnotreqired/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@cftnotreqired',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@cftnotreqired',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'cftnotreqired',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviation_qa_more_info' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/deviation/Qa/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_qa_more_info',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@deviation_qa_more_info',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviation_qa_more_info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deviationSingleReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/deviationSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'deviationSingleReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'launch-extension-deviation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/launch-extension-deviation/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionDeviation',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionDeviation',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'launch-extension-deviation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'launch-extension-capa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/launch-extension-capa/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionCapa',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionCapa',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'launch-extension-capa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'launch-extension-qrm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/launch-extension-qrm/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionQrm',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionQrm',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'launch-extension-qrm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'launch-extension-investigation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/launch-extension-investigation/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionInvestigation',
        'controller' => 'App\\Http\\Controllers\\rcms\\DeviationController@launchExtensionInvestigation',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'launch-extension-investigation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tNExPLwBBqmgy8Cs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/failure-investigation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\FailureInvestigationController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\FailureInvestigationController@index',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::tNExPLwBBqmgy8Cs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oot.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oot',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@index',
        'as' => 'oot.index',
        'namespace' => NULL,
        'prefix' => 'rcms/oot',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oot.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oot/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@store',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'oot.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rcms/oot_view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oot_view/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@ootShow',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@ootShow',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'rcms/oot_view',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oot/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@update',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ootStage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oot/stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@oot_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@oot_send_stage',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'ootStage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EaXz7SCs2xDjJcIA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oot_audit_history/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@OotAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@OotAuditTrial',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::EaXz7SCs2xDjJcIA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auditdetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/rcms/auditdetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@OotAuditDetail',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@OotAuditDetail',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'auditdetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SvlhmEXjRI1F9bOo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/ootcSingleReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::SvlhmEXjRI1F9bOo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZhFFWMpYcoVmDEno' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/sendstage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@oot_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@oot_send_stage',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::ZhFFWMpYcoVmDEno',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yZiVyUC6aP3Z8IyW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/thirdStage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@stageChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@stageChange',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::yZiVyUC6aP3Z8IyW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uvSXVoMvHlyRTTFN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@oot_reject',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@oot_reject',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::uvSXVoMvHlyRTTFN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ykrpAu3oorUM0Vxq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/audit_pdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@auditTiailPdf',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@auditTiailPdf',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::ykrpAu3oorUM0Vxq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oot.ootstore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oot/ootstore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOTController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOTController@store',
        'as' => 'oot.ootstore',
        'namespace' => NULL,
        'prefix' => 'rcms/oot',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@index',
        'as' => 'oos.index',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.oosstore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/oosstore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@store',
        'as' => 'oos.oosstore',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.oos_view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oos/oos_view/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@show',
        'as' => 'oos.oos_view',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.oosupdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/oosupdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@update',
        'as' => 'oos.oosupdate',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/sendstage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@send_stage',
        'as' => 'oos.send_stage',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.requestmoreinfo_back_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/requestmoreinfo_back_stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@requestmoreinfo_back_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@requestmoreinfo_back_stage',
        'as' => 'oos.requestmoreinfo_back_stage',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.assignable_send_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/assignable_send_stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@assignable_send_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@assignable_send_stage',
        'as' => 'oos.assignable_send_stage',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.cancel_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/cancel_stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@cancel_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@cancel_stage',
        'as' => 'oos.cancel_stage',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.thirdStage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/thirdStage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@stageChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@stageChange',
        'as' => 'oos.thirdStage',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.reject_stage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/reject_stage/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@reject_stage',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@reject_stage',
        'as' => 'oos.reject_stage',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.capa_child_changecontrol' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/oos/capa_child/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\CapaController@child_change_control',
        'controller' => 'App\\Http\\Controllers\\rcms\\CapaController@child_change_control',
        'as' => 'oos.capa_child_changecontrol',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.audit_trial' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oos/AuditTrial/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@AuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@AuditTrial',
        'as' => 'oos.audit_trial',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.audit_details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oos/auditDetails/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@auditDetails',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@auditDetails',
        'as' => 'oos.audit_details',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.audit_report' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oos/audit_report/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@auditReport',
        'as' => 'oos.audit_report',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oos.single_report' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/oos/single_report/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\OOSController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\OOSController@singleReport',
        'as' => 'oos.single_report',
        'namespace' => NULL,
        'prefix' => 'rcms/oos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.market_complaint_new' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/marketcomplaint/market_complaint_new',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@index',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@index',
        'as' => 'marketcomplaint.market_complaint_new',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.mcstore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/marketcomplaint/marketcomplaint/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@store',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@store',
        'as' => 'marketcomplaint.mcstore',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.marketcomplaint_view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/marketcomplaint/marketcomplaint_view/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@show',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@show',
        'as' => 'marketcomplaint.marketcomplaint_view',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.marketcomplaintupdate' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'rcms/marketcomplaint/marketcomplaintupdate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@update',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@update',
        'as' => 'marketcomplaint.marketcomplaintupdate',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.mar_comp_stagechange' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/marketcomplaint/mar_comp_stagechange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@marketComplaintStateChange',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@marketComplaintStateChange',
        'as' => 'marketcomplaint.mar_comp_stagechange',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.mar_comp_reject_stateChange' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/marketcomplaint/mar_comp_reject_stateChange/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@marketComplaintRejectState',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@marketComplaintRejectState',
        'as' => 'marketcomplaint.mar_comp_reject_stateChange',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.MarketComplaintCancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rcms/marketcomplaint/MarketComplaintCancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@MarketComplaintCancel',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@MarketComplaintCancel',
        'as' => 'marketcomplaint.MarketComplaintCancel',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.marketauditDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/marketcomplaint/auditDetailsMarket/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@auditDetailsMarket',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@auditDetailsMarket',
        'as' => 'marketcomplaint.marketauditDetails',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.MarketComplaintAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/marketcomplaint/MarketComplaintAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@MarketAuditTrial',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@MarketAuditTrial',
        'as' => 'marketcomplaint.MarketComplaintAuditReport',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.marketAuditReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/marketcomplaint/MarketAuditReport/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@auditReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@auditReport',
        'as' => 'marketcomplaint.marketAuditReport',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'marketcomplaint.marketauditTrailPdf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/marketcomplaint/marketauditTrailPdf/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@auditTrailPdf',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@auditTrailPdf',
        'as' => 'marketcomplaint.marketauditTrailPdf',
        'namespace' => NULL,
        'prefix' => 'rcms/marketcomplaint',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::80FO4EdyCSsWTwcQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rcms/pdf-report/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'rcms',
        ),
        'uses' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@singleReport',
        'controller' => 'App\\Http\\Controllers\\rcms\\MarketComplaintController@singleReport',
        'namespace' => NULL,
        'prefix' => '/rcms',
        'where' => 
        array (
        ),
        'as' => 'generated::80FO4EdyCSsWTwcQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
