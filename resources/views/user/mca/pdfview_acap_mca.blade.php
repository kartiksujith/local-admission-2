<!DOCTYPE html>
<html>
   <head>
      <title>{{ "MCA_ACAP_".$users1[0]->name_on_marksheet }}</title>
      <style>
         th {
         text-align: left;
         }
         .table {
         width: 100%;
         max-width: 100%;
         margin-bottom: 20px;
         }
         .table > thead > tr > th,
         .table > tbody > tr > th,
         .table > tfoot > tr > th,
         .table > thead > tr > td,
         .table > tbody > tr > td,
         .table > tfoot > tr > td {
         padding: 8px;
         line-height: 1.42857143;
         vertical-align: top;
         border-top: 1px solid #ddd;
         }
         .table > thead > tr > th {
         vertical-align: bottom;
         border-bottom: 2px solid #ddd;
         }
         .table > caption + thead > tr:first-child > th,
         .table > colgroup + thead > tr:first-child > th,
         .table > thead:first-child > tr:first-child > th,
         .table > caption + thead > tr:first-child > td,
         .table > colgroup + thead > tr:first-child > td,
         .table > thead:first-child > tr:first-child > td {
         border-top: 0;
         }
         .table > tbody + tbody {
         border-top: 2px solid #ddd;
         }
         .table .table {
         background-color: #fff;
         }
         .table-condensed > thead > tr > th,
         .table-condensed > tbody > tr > th,
         .table-condensed > tfoot > tr > th,
         .table-condensed > thead > tr > td,
         .table-condensed > tbody > tr > td,
         .table-condensed > tfoot > tr > td {
         padding: 5px;
         }
         .table-bordered {
         border: 1px solid #ddd;
         }
         .table-bordered > thead > tr > th,
         .table-bordered > tbody > tr > th,
         .table-bordered > tfoot > tr > th,
         .table-bordered > thead > tr > td,
         .table-bordered > tbody > tr > td,
         .table-bordered > tfoot > tr > td {
         border: 1px solid #ddd;
         }
         .table-bordered > thead > tr > th,
         .table-bordered > thead > tr > td {
         border-bottom-width: 2px;
         }
         .table-striped > tbody > tr:nth-of-type(odd) {
         background-color: #f9f9f9;
         }
         .table-hover > tbody > tr:hover {
         background-color: #f5f5f5;
         }
         table col[class*="col-"] {
         position: static;
         display: table-column;
         float: none;
         }
         table td[class*="col-"],
         table th[class*="col-"] {
         position: static;
         display: table-cell;
         float: none;
         }
         .table > thead > tr > td.active,
         .table > tbody > tr > td.active,
         .table > tfoot > tr > td.active,
         .table > thead > tr > th.active,
         .table > tbody > tr > th.active,
         .table > tfoot > tr > th.active,
         .table > thead > tr.active > td,
         .table > tbody > tr.active > td,
         .table > tfoot > tr.active > td,
         .table > thead > tr.active > th,
         .table > tbody > tr.active > th,
         .table > tfoot > tr.active > th {
         background-color: #f5f5f5;
         }
         .table-hover > tbody > tr > td.active:hover,
         .table-hover > tbody > tr > th.active:hover,
         .table-hover > tbody > tr.active:hover > td,
         .table-hover > tbody > tr:hover > .active,
         .table-hover > tbody > tr.active:hover > th {
         background-color: #e8e8e8;
         }
         .table > thead > tr > td.success,
         .table > tbody > tr > td.success,
         .table > tfoot > tr > td.success,
         .table > thead > tr > th.success,
         .table > tbody > tr > th.success,
         .table > tfoot > tr > th.success,
         .table > thead > tr.success > td,
         .table > tbody > tr.success > td,
         .table > tfoot > tr.success > td,
         .table > thead > tr.success > th,
         .table > tbody > tr.success > th,
         .table > tfoot > tr.success > th {
         background-color: #dff0d8;
         }
         .table-hover > tbody > tr > td.success:hover,
         .table-hover > tbody > tr > th.success:hover,
         .table-hover > tbody > tr.success:hover > td,
         .table-hover > tbody > tr:hover > .success,
         .table-hover > tbody > tr.success:hover > th {
         background-color: #d0e9c6;
         }
         .table > thead > tr > td.info,
         .table > tbody > tr > td.info,
         .table > tfoot > tr > td.info,
         .table > thead > tr > th.info,
         .table > tbody > tr > th.info,
         .table > tfoot > tr > th.info,
         .table > thead > tr.info > td,
         .table > tbody > tr.info > td,
         .table > tfoot > tr.info > td,
         .table > thead > tr.info > th,
         .table > tbody > tr.info > th,
         .table > tfoot > tr.info > th {
         background-color: #d9edf7;
         }
         .table-hover > tbody > tr > td.info:hover,
         .table-hover > tbody > tr > th.info:hover,
         .table-hover > tbody > tr.info:hover > td,
         .table-hover > tbody > tr:hover > .info,
         .table-hover > tbody > tr.info:hover > th {
         background-color: #c4e3f3;
         }
         .table > thead > tr > td.warning,
         .table > tbody > tr > td.warning,
         .table > tfoot > tr > td.warning,
         .table > thead > tr > th.warning,
         .table > tbody > tr > th.warning,
         .table > tfoot > tr > th.warning,
         .table > thead > tr.warning > td,
         .table > tbody > tr.warning > td,
         .table > tfoot > tr.warning > td,
         .table > thead > tr.warning > th,
         .table > tbody > tr.warning > th,
         .table > tfoot > tr.warning > th {
         background-color: #fcf8e3;
         }
         .table-hover > tbody > tr > td.warning:hover,
         .table-hover > tbody > tr > th.warning:hover,
         .table-hover > tbody > tr.warning:hover > td,
         .table-hover > tbody > tr:hover > .warning,
         .table-hover > tbody > tr.warning:hover > th {
         background-color: #faf2cc;
         }
         .table > thead > tr > td.danger,
         .table > tbody > tr > td.danger,
         .table > tfoot > tr > td.danger,
         .table > thead > tr > th.danger,
         .table > tbody > tr > th.danger,
         .table > tfoot > tr > th.danger,
         .table > thead > tr.danger > td,
         .table > tbody > tr.danger > td,
         .table > tfoot > tr.danger > td,
         .table > thead > tr.danger > th,
         .table > tbody > tr.danger > th,
         .table > tfoot > tr.danger > th {
         background-color: #f2dede;
         }
         .table-hover > tbody > tr > td.danger:hover,
         .table-hover > tbody > tr > th.danger:hover,
         .table-hover > tbody > tr.danger:hover > td,
         .table-hover > tbody > tr:hover > .danger,
         .table-hover > tbody > tr.danger:hover > th {
         background-color: #ebcccc;
         }
         .table-responsive {
         min-height: .01%;
         overflow-x: auto;
         }
         @media screen and (max-width: 767px) {
         .table-responsive {
         width: 100%;
         margin-bottom: 15px;
         overflow-y: hidden;
         -ms-overflow-style: -ms-autohiding-scrollbar;
         border: 1px solid #ddd;
         }
         .table-responsive > .table {
         margin-bottom: 0;
         }
         .table-responsive > .table > thead > tr > th,
         .table-responsive > .table > tbody > tr > th,
         .table-responsive > .table > tfoot > tr > th,
         .table-responsive > .table > thead > tr > td,
         .table-responsive > .table > tbody > tr > td,
         .table-responsive > .table > tfoot > tr > td {
         white-space: nowrap;
         }
         .table-responsive > .table-bordered {
         border: 0;
         }
         .table-responsive > .table-bordered > thead > tr > th:first-child,
         .table-responsive > .table-bordered > tbody > tr > th:first-child,
         .table-responsive > .table-bordered > tfoot > tr > th:first-child,
         .table-responsive > .table-bordered > thead > tr > td:first-child,
         .table-responsive > .table-bordered > tbody > tr > td:first-child,
         .table-responsive > .table-bordered > tfoot > tr > td:first-child {
         border-left: 0;
         }
         .table-responsive > .table-bordered > thead > tr > th:last-child,
         .table-responsive > .table-bordered > tbody > tr > th:last-child,
         .table-responsive > .table-bordered > tfoot > tr > th:last-child,
         .table-responsive > .table-bordered > thead > tr > td:last-child,
         .table-responsive > .table-bordered > tbody > tr > td:last-child,
         .table-responsive > .table-bordered > tfoot > tr > td:last-child {
         border-right: 0;
         }
         .table-responsive > .table-bordered > tbody > tr:last-child > th,
         .table-responsive > .table-bordered > tfoot > tr:last-child > th,
         .table-responsive > .table-bordered > tbody > tr:last-child > td,
         .table-responsive > .table-bordered > tfoot > tr:last-child > td {
         border-bottom: 0;
         }
         }
         #page_break{
         page-break-before: always;
         }
         td{
         vertical-align: middle;
         }
         p{
         font-size:14px;
         text-align:justify;
         padding:0;
         }
         #hide
         {
         font-size: 14px;
         border:0px;
         border-right: 1px solid black;
         border-left: 1px solid black;
         border-top: 1px solid black;
         border-bottom: 1px solid black;
         font-weight: bold;
         }
         #data
         {
         font-size: 14px;
         border-right: 1px solid black;
         border-left: 1px solid black;
         border-top: 1px solid black;
         border-bottom: 1px solid black;
         /*white-space: nowrap;*/ 
         }
         #brand
         {
         text-align: center; 
         font-size: 21px;
         border-top: 2px solid black;
         border-bottom: 2px solid black;
         }
         #line
         {
         border-right: 0px solid black;
         border-left: 0px solid black;
         border-top: 0px solid black;
         border-bottom: 0px solid black; 
         }
         body
         {
         margin: 0mm -18mm -5mm -15mm;
         /*0mm -18mm -5mm -18mm*/
         /*top right bottom left*/
         }
         .container {
         padding-right: 15px;
         padding-left: 15px;
         margin-right: auto;
         margin-left: auto;
         }
         @media (min-width: 768px) {
         .container {
         width: 750px;
         }
         }
         @media (min-width: 992px) {
         .container {
         width: 970px;
         }
         }
         @media (min-width: 1200px) {
         .container {
         width: 1170px;
         }
         }
         .row {
         margin-right: -15px;
         margin-left: -15px;
         }
         .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
         position: relative;
         min-height: 1px;
         padding-right: 15px;
         padding-left: 15px;
         }
         .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
         float: left;
         }
         .col-xs-12 {
         width: 100%;
         }
         .col-xs-11 {
         width: 91.66666667%;
         }
         .col-xs-10 {
         width: 83.33333333%;
         }
         .col-xs-9 {
         width: 75%;
         }
         .col-xs-8 {
         width: 66.66666667%;
         }
         .col-xs-7 {
         width: 58.33333333%;
         }
         .col-xs-6 {
         width: 50%;
         }
         .col-xs-5 {
         width: 41.66666667%;
         }
         .col-xs-4 {
         width: 33.33333333%;
         }
         .col-xs-3 {
         width: 25%;
         }
         .col-xs-2 {
         width: 16.66666667%;
         }
         .col-xs-1 {
         width: 8.33333333%;
         }
         .col-xs-pull-12 {
         right: 100%;
         }
         .col-xs-pull-11 {
         right: 91.66666667%;
         }
         .col-xs-pull-10 {
         right: 83.33333333%;
         }
         .col-xs-pull-9 {
         right: 75%;
         }
         .col-xs-pull-8 {
         right: 66.66666667%;
         }
         .col-xs-pull-7 {
         right: 58.33333333%;
         }
         .col-xs-pull-6 {
         right: 50%;
         }
         .col-xs-pull-5 {
         right: 41.66666667%;
         }
         .col-xs-pull-4 {
         right: 33.33333333%;
         }
         .col-xs-pull-3 {
         right: 25%;
         }
         .col-xs-pull-2 {
         right: 16.66666667%;
         }
         .col-xs-pull-1 {
         right: 8.33333333%;
         }
         .col-xs-pull-0 {
         right: auto;
         }
         .col-xs-push-12 {
         left: 100%;
         }
         .col-xs-push-11 {
         left: 91.66666667%;
         }
         .col-xs-push-10 {
         left: 83.33333333%;
         }
         .col-xs-push-9 {
         left: 75%;
         }
         .col-xs-push-8 {
         left: 66.66666667%;
         }
         .col-xs-push-7 {
         left: 58.33333333%;
         }
         .col-xs-push-6 {
         left: 50%;
         }
         .col-xs-push-5 {
         left: 41.66666667%;
         }
         .col-xs-push-4 {
         left: 33.33333333%;
         }
         .col-xs-push-3 {
         left: 25%;
         }
         .col-xs-push-2 {
         left: 16.66666667%;
         }
         .col-xs-push-1 {
         left: 8.33333333%;
         }
         .col-xs-push-0 {
         left: auto;
         }
         .col-xs-offset-12 {
         margin-left: 100%;
         }
         .col-xs-offset-11 {
         margin-left: 91.66666667%;
         }
         .col-xs-offset-10 {
         margin-left: 83.33333333%;
         }
         .col-xs-offset-9 {
         margin-left: 75%;
         }
         .col-xs-offset-8 {
         margin-left: 66.66666667%;
         }
         .col-xs-offset-7 {
         margin-left: 58.33333333%;
         }
         .col-xs-offset-6 {
         margin-left: 50%;
         }
         .col-xs-offset-5 {
         margin-left: 41.66666667%;
         }
         .col-xs-offset-4 {
         margin-left: 33.33333333%;
         }
         .col-xs-offset-3 {
         margin-left: 25%;
         }
         .col-xs-offset-2 {
         margin-left: 16.66666667%;
         }
         .col-xs-offset-1 {
         margin-left: 8.33333333%;
         }
         .col-xs-offset-0 {
         margin-left: 0;
         }
         @media (min-width: 768px) {
         .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
         float: left;
         }
         .col-sm-12 {
         width: 100%;
         }
         .col-sm-11 {
         width: 91.66666667%;
         }
         .col-sm-10 {
         width: 83.33333333%;
         }
         .col-sm-9 {
         width: 75%;
         }
         .col-sm-8 {
         width: 66.66666667%;
         }
         .col-sm-7 {
         width: 58.33333333%;
         }
         .col-sm-6 {
         width: 50%;
         }
         .col-sm-5 {
         width: 41.66666667%;
         }
         .col-sm-4 {
         width: 33.33333333%;
         }
         .col-sm-3 {
         width: 25%;
         }
         .col-sm-2 {
         width: 16.66666667%;
         }
         .col-sm-1 {
         width: 8.33333333%;
         }
         .col-sm-pull-12 {
         right: 100%;
         }
         .col-sm-pull-11 {
         right: 91.66666667%;
         }
         .col-sm-pull-10 {
         right: 83.33333333%;
         }
         .col-sm-pull-9 {
         right: 75%;
         }
         .col-sm-pull-8 {
         right: 66.66666667%;
         }
         .col-sm-pull-7 {
         right: 58.33333333%;
         }
         .col-sm-pull-6 {
         right: 50%;
         }
         .col-sm-pull-5 {
         right: 41.66666667%;
         }
         .col-sm-pull-4 {
         right: 33.33333333%;
         }
         .col-sm-pull-3 {
         right: 25%;
         }
         .col-sm-pull-2 {
         right: 16.66666667%;
         }
         .col-sm-pull-1 {
         right: 8.33333333%;
         }
         .col-sm-pull-0 {
         right: auto;
         }
         .col-sm-push-12 {
         left: 100%;
         }
         .col-sm-push-11 {
         left: 91.66666667%;
         }
         .col-sm-push-10 {
         left: 83.33333333%;
         }
         .col-sm-push-9 {
         left: 75%;
         }
         .col-sm-push-8 {
         left: 66.66666667%;
         }
         .col-sm-push-7 {
         left: 58.33333333%;
         }
         .col-sm-push-6 {
         left: 50%;
         }
         .col-sm-push-5 {
         left: 41.66666667%;
         }
         .col-sm-push-4 {
         left: 33.33333333%;
         }
         .col-sm-push-3 {
         left: 25%;
         }
         .col-sm-push-2 {
         left: 16.66666667%;
         }
         .col-sm-push-1 {
         left: 8.33333333%;
         }
         .col-sm-push-0 {
         left: auto;
         }
         .col-sm-offset-12 {
         margin-left: 100%;
         }
         .col-sm-offset-11 {
         margin-left: 91.66666667%;
         }
         .col-sm-offset-10 {
         margin-left: 83.33333333%;
         }
         .col-sm-offset-9 {
         margin-left: 75%;
         }
         .col-sm-offset-8 {
         margin-left: 66.66666667%;
         }
         .col-sm-offset-7 {
         margin-left: 58.33333333%;
         }
         .col-sm-offset-6 {
         margin-left: 50%;
         }
         .col-sm-offset-5 {
         margin-left: 41.66666667%;
         }
         .col-sm-offset-4 {
         margin-left: 33.33333333%;
         }
         .col-sm-offset-3 {
         margin-left: 25%;
         }
         .col-sm-offset-2 {
         margin-left: 16.66666667%;
         }
         .col-sm-offset-1 {
         margin-left: 8.33333333%;
         }
         .col-sm-offset-0 {
         margin-left: 0;
         }
         }
         @media (min-width: 992px) {
         .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
         float: left;
         }
         .col-md-12 {
         width: 100%;
         }
         .col-md-11 {
         width: 91.66666667%;
         }
         .col-md-10 {
         width: 83.33333333%;
         }
         .col-md-9 {
         width: 75%;
         }
         .col-md-8 {
         width: 66.66666667%;
         }
         .col-md-7 {
         width: 58.33333333%;
         }
         .col-md-6 {
         width: 50%;
         }
         .col-md-5 {
         width: 41.66666667%;
         }
         .col-md-4 {
         width: 33.33333333%;
         }
         .col-md-3 {
         width: 25%;
         }
         .col-md-2 {
         width: 16.66666667%;
         }
         .col-md-1 {
         width: 8.33333333%;
         }
         .col-md-pull-12 {
         right: 100%;
         }
         .col-md-pull-11 {
         right: 91.66666667%;
         }
         .col-md-pull-10 {
         right: 83.33333333%;
         }
         .col-md-pull-9 {
         right: 75%;
         }
         .col-md-pull-8 {
         right: 66.66666667%;
         }
         .col-md-pull-7 {
         right: 58.33333333%;
         }
         .col-md-pull-6 {
         right: 50%;
         }
         .col-md-pull-5 {
         right: 41.66666667%;
         }
         .col-md-pull-4 {
         right: 33.33333333%;
         }
         .col-md-pull-3 {
         right: 25%;
         }
         .col-md-pull-2 {
         right: 16.66666667%;
         }
         .col-md-pull-1 {
         right: 8.33333333%;
         }
         .col-md-pull-0 {
         right: auto;
         }
         .col-md-push-12 {
         left: 100%;
         }
         .col-md-push-11 {
         left: 91.66666667%;
         }
         .col-md-push-10 {
         left: 83.33333333%;
         }
         .col-md-push-9 {
         left: 75%;
         }
         .col-md-push-8 {
         left: 66.66666667%;
         }
         .col-md-push-7 {
         left: 58.33333333%;
         }
         .col-md-push-6 {
         left: 50%;
         }
         .col-md-push-5 {
         left: 41.66666667%;
         }
         .col-md-push-4 {
         left: 33.33333333%;
         }
         .col-md-push-3 {
         left: 25%;
         }
         .col-md-push-2 {
         left: 16.66666667%;
         }
         .col-md-push-1 {
         left: 8.33333333%;
         }
         .col-md-push-0 {
         left: auto;
         }
         .col-md-offset-12 {
         margin-left: 100%;
         }
         .col-md-offset-11 {
         margin-left: 91.66666667%;
         }
         .col-md-offset-10 {
         margin-left: 83.33333333%;
         }
         .col-md-offset-9 {
         margin-left: 75%;
         }
         .col-md-offset-8 {
         margin-left: 66.66666667%;
         }
         .col-md-offset-7 {
         margin-left: 58.33333333%;
         }
         .col-md-offset-6 {
         margin-left: 50%;
         }
         .col-md-offset-5 {
         margin-left: 41.66666667%;
         }
         .col-md-offset-4 {
         margin-left: 33.33333333%;
         }
         .col-md-offset-3 {
         margin-left: 25%;
         }
         .col-md-offset-2 {
         margin-left: 16.66666667%;
         }
         .col-md-offset-1 {
         margin-left: 8.33333333%;
         }
         .col-md-offset-0 {
         margin-left: 0;
         }
         }
         @media (min-width: 1200px) {
         .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
         float: left;
         }
         .col-lg-12 {
         width: 100%;
         }
         .col-lg-11 {
         width: 91.66666667%;
         }
         .col-lg-10 {
         width: 83.33333333%;
         }
         .col-lg-9 {
         width: 75%;
         }
         .col-lg-8 {
         width: 66.66666667%;
         }
         .col-lg-7 {
         width: 58.33333333%;
         }
         .col-lg-6 {
         width: 50%;
         }
         .col-lg-5 {
         width: 41.66666667%;
         }
         .col-lg-4 {
         width: 33.33333333%;
         }
         .col-lg-3 {
         width: 25%;
         }
         .col-lg-2 {
         width: 16.66666667%;
         }
         .col-lg-1 {
         width: 8.33333333%;
         }
         .col-lg-pull-12 {
         right: 100%;
         }
         .col-lg-pull-11 {
         right: 91.66666667%;
         }
         .col-lg-pull-10 {
         right: 83.33333333%;
         }
         .col-lg-pull-9 {
         right: 75%;
         }
         .col-lg-pull-8 {
         right: 66.66666667%;
         }
         .col-lg-pull-7 {
         right: 58.33333333%;
         }
         .col-lg-pull-6 {
         right: 50%;
         }
         .col-lg-pull-5 {
         right: 41.66666667%;
         }
         .col-lg-pull-4 {
         right: 33.33333333%;
         }
         .col-lg-pull-3 {
         right: 25%;
         }
         .col-lg-pull-2 {
         right: 16.66666667%;
         }
         .col-lg-pull-1 {
         right: 8.33333333%;
         }
         .col-lg-pull-0 {
         right: auto;
         }
         .col-lg-push-12 {
         left: 100%;
         }
         .col-lg-push-11 {
         left: 91.66666667%;
         }
         .col-lg-push-10 {
         left: 83.33333333%;
         }
         .col-lg-push-9 {
         left: 75%;
         }
         .col-lg-push-8 {
         left: 66.66666667%;
         }
         .col-lg-push-7 {
         left: 58.33333333%;
         }
         .col-lg-push-6 {
         left: 50%;
         }
         .col-lg-push-5 {
         left: 41.66666667%;
         }
         .col-lg-push-4 {
         left: 33.33333333%;
         }
         .col-lg-push-3 {
         left: 25%;
         }
         .col-lg-push-2 {
         left: 16.66666667%;
         }
         .col-lg-push-1 {
         left: 8.33333333%;
         }
         .col-lg-push-0 {
         left: auto;
         }
         .col-lg-offset-12 {
         margin-left: 100%;
         }
         .col-lg-offset-11 {
         margin-left: 91.66666667%;
         }
         .col-lg-offset-10 {
         margin-left: 83.33333333%;
         }
         .col-lg-offset-9 {
         margin-left: 75%;
         }
         .col-lg-offset-8 {
         margin-left: 66.66666667%;
         }
         .col-lg-offset-7 {
         margin-left: 58.33333333%;
         }
         .col-lg-offset-6 {
         margin-left: 50%;
         }
         .col-lg-offset-5 {
         margin-left: 41.66666667%;
         }
         .col-lg-offset-4 {
         margin-left: 33.33333333%;
         }
         .col-lg-offset-3 {
         margin-left: 25%;
         }
         .col-lg-offset-2 {
         margin-left: 16.66666667%;
         }
         .col-lg-offset-1 {
         margin-left: 8.33333333%;
         }
         .col-lg-offset-0 {
         margin-left: 0;
         }
         }
         .form-group {
         margin-bottom: 15px;
         }
         @media (min-width: 992px)
         .col-md-12 {
         width: 100%;
         }
         .form-control {
         display: block;
         width: 100%;
         height: 34px;
         padding: 6px 12px;
         font-size: 14px;
         line-height: 1.42857143;
         color: #555;
         background-color: #fff;
         background-image: none;
         border: 1px solid #ccc;
         border-radius: 4px;
         -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
         box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
         -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
         -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
         transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
         }
         .form-control:focus {
         border-color: #66afe9;
         outline: 0;
         -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
         box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
         }
         .form-control::-moz-placeholder {
         color: #999;
         opacity: 1;
         }
         .form-control:-ms-input-placeholder {
         color: #999;
         }
         .form-control::-webkit-input-placeholder {
         color: #999;
         }
         .form-control::-ms-expand {
         background-color: transparent;
         border: 0;
         }
         .form-group {
         margin-bottom: 15px;
         }
         .label {
         display: inline;
         padding: .2em .6em .3em;
         font-size: 75%;
         font-weight: bold;
         line-height: 1;
         color: #fff;
         text-align: center;
         white-space: nowrap;
         vertical-align: baseline;
         border-radius: .25em;
         }
         .img-responsive,
         .thumbnail > img,
         .thumbnail a > img,
         .carousel-inner > .item > img,
         .carousel-inner > .item > a > img {
         display: block;
         max-width: 100%;
         height: auto;
         }
         body{
         margin-top: -30px;
         margin-bottom: -40px;
         }
         img {
         border: 0;
         }
      </style>
   </head>
   <body>
      <!-------------------------------------------Page 1-------------------------------------------------->
      <div class="container" style="margin-left: 50px;margin-right: 100px;">
         <div class="col-md-12">
            <center>
                <img class="img-responsive" src="{{ asset('images/acap_header_mca_admissionForm.jpg') }}">
                <label style="font-size:25px;">APPLICATION FORM</label>
            </center>
         </div>
         <div class="col-md-12">
            <div class="form-group">
               <div class="col-md-12">
                  <table>
                     <thead>
                        <tr>
                           <th id="line" colspan="6">DTE ID: {{ $users1[0]->dte_id }}</th>
                        </tr>
                        <tr>
                           <th id="brand" colspan="6">Personal Details</th>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Candidate's Name</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1[0]->name_on_marksheet }}</td>
                           <td id="hide" rowspan="6">
                              <center><img src="{{ asset('/public/uploads/'.$users1[0]->dte_id.'_'.$users1['hash'].'/'.$users1[0]->photo_path) }}" style="width: 200px; height: 200px;" alt="Missing Image" /></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Gender</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1[0]->gender }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Date Of Birth</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1[0]->date_of_birth }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Unique Id/Aadhar<br>&nbsp;&nbsp;&nbsp;No.</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1[0]->uid }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Email ID</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1['email'] }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Mobile No.</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1['mobile'] }}</td>
                        </tr>
                        <tr>
                           <td id="hide" rowspan="2">&nbsp;&nbsp;&nbsp;Permanent Address</td>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;{{ $users1[0]->permanent_address_line1 }}</td>
                        </tr>
                        <tr>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;{{ $users1[0]->permanent_address_line2 }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;District</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->permanent_district }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;State</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->permanent_state }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Pincode</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->permanent_pincode }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Nearest Railway<br>&nbsp;&nbsp;&nbsp;Station</td>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;{{ $users1[0]->permanent_nearest_rail_station }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Cast & Tribe</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->caste_tribe }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Place Of Birth</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->place_of_birth_city }}, {{ $users1[0]->place_of_birth_state }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Nationality</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->nationality }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Religion</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->religion }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Mother<br>&nbsp;&nbsp;&nbsp;Tongue</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->mother_tongue }}</td>
                        </tr>
                        @if( $users1[0]->student_domicile_appl_no != 0 && $users1[0]->student_domicile_no != 0)
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        @endif
                        @if($users1[0]->student_domicile_appl_no != 0)
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Domicile Application No.</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->student_domicile_appl_no }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Dated</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->student_domicile_appl_date }}</td>
                        </tr>
                        @endif
                        @if($users1[0]->student_domicile_no != 0)
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Domicile Serial No.</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->student_domicile_no }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Dated</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->student_domicile_date }}</td>
                        </tr>
                        @endif
                        
                        
                        <tr>
                           <th id="brand" colspan="6">DTE Details</th>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;CET Score</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->cet_score }}</td>
                           <td id="hide">&nbsp;&nbsp;Month &<br>&nbsp;&nbsp;&nbsp;Year of CET Exam</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->cet_month }}, {{ $users1[0]->cet_year }}</td>
                            <td id="hide">&nbsp;&nbsp;&nbsp;MH-State<br>&nbsp;&nbsp;&nbsp;General<br>&nbsp;&nbsp;&nbsp;Merit No.</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->mh_state_general_merit_no }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Type Of Seat</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->seat_type }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Candidature Type</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;Type - {{ $users1[0]->candidate_type }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Category</td>
                           @if($users1[0]->acap_category == "NA" || $users1[0]->acap_category == null)
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->category }}</td>
                           @else
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->acap_category }}</td>
                           @endif
                           <td id="hide" colspan="2">&nbsp;&nbsp;&nbsp;If Reserved (Category)</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;<!--{{ $users1[0]->candidate_type }}--></td>
                        </tr>
                        {{-- 
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Registration Number</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->gate_reg_no }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Examination Paper</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->gate_exam_paper }}</td>
                        </tr>
                        --}}
                        <tr>
                           <th id="brand" colspan="6">Details of Bachelor's Degree or equivalent in the field of Engineering/Technology</th>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;University</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_university }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;University Type</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->university_type }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Name Of Institute</td>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_college_name }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Degree</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_name }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Branch</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_branch }}</td>
                        </tr>
                        <tr>
                           <td id="hide" colspan="2">&nbsp;&nbsp;&nbsp;Month & Year of Passing</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_passing_month }}, {{ $users1[0]->degree_passing_year }}</td>
                           <td id="hide" colspan="2">&nbsp;&nbsp;&nbsp;Total Marks</td>
                           <td id="data">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_aggr_obt_marks }} / {{ $users1[0]->degree_aggr_max_marks }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Percentage</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_percentage }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;C.G.P.A</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_final_cgpa }}</td>
                        </tr>
                        
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        
                        <tr>
                           <th id="brand" colspan="6">Details of Previous Examination</th>
                        </tr>
                        <tr>
                           <th id="line" colspan="6" style="text-align: center; font-size: 15px;">10th/SSC/Equivalent*</th>
                        </tr>
                        <tr>
                           <td id="hide" style="text-align: center;" colspan="2">Board & Name & Address of School/College</td>
                           <td id="hide" style="text-align: center;">Month & Year of Passing</td>
                           <td id="hide" style="text-align: center;">Marks Obtained</td>
                           <td id="hide" style="text-align: center;" style="text-align: center;">Maximum Marks</td>
                           <td id="hide" style="text-align: center;">Percentage</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_board }} - {{ $users1[0]->x_school_name}} - {{ $users1[0]->x_school_city}} - {{ $users1[0]->x_school_state}}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_passing_month }} {{ $users1[0]->x_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_obtained_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_max_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_percentage }}</td>
                        </tr>
                        @if( $users1[0]->is_diploma == "D" )
                        <tr>
                           <th id="line" colspan="6" style="text-align: center; font-size: 15px;">Diploma*</th>
                        </tr>
                        <tr>
                           <td id="hide" style="text-align: center;">University & Name of College & Branch</td>
                           <td id="hide" style="text-align: center;">Address of college & Year of Passing</td>
                           <td id="hide" style="text-align: center;">Month & Year of Passing</td>
                           <td id="hide" style="text-align: center;">Marks Obtained</td>
                           <td id="hide" style="text-align: center;">Maximum Marks</td>
                           <td id="hide" style="text-align: center;">Percentage</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;" >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_university }}, {{ $users1[0]->diploma_college_name}} , {{$users1[0]->diploma_branch}}</td>
                            <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_college_city }} {{ $users1[0]->diploma_college_state }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_passing_month }} {{ $users1[0]->diploma_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_obtained_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_percentage }}</td>
                        </tr>
                        @else
                        <tr>
                           <th id="line" colspan="6" style="text-align: center; font-size: 15px;">12th/HSC/Equivalent*</th>
                        </tr>
                        <tr>
                           <td id="hide" style="text-align: center;" colspan="2">Board & Name & Address of School/College</td>
                           <td id="hide" style="text-align: center;">Month & Year of Passing</td>
                           <td id="hide" style="text-align: center;">Marks Obtained</td>
                           <td id="hide" style="text-align: center;">Maximum Marks</td>
                           <td id="hide" style="text-align: center;">Percentage</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_board }} - {{ $users1[0]->xii_college_name }}-{{ $users1[0]->xii_college_city }}-{{ $users1[0]->xii_college_state }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_passing_month }} {{ $users1[0]->xii_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_obtained_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_max_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_percentage }}</td>
                        </tr>
                        @endif
                        <tr>
                           <th id="line" colspan="6" style="text-align: center; font-size: 15px;">B.E/B.TECH/B.SC/BCA* </th>
                        </tr>
                        
                        @if($users1[0]->is_new_or_old == "P")
                        <tr>
                           <td id="hide" style="text-align: center;">University & Name of College & Degree & Branch</td>
                           <td id="hide" style="text-align: center;">Month & Year of Passing</td>
                           <td id="hide" style="text-align: center;">Sem 3 SGPA</td>
                           <td id="hide" style="text-align: center;">Sem 4 SGPA</td>
                           <td id="hide" style="text-align: center;">Sem 5 SGPA</td>
                           <td id="hide" style="text-align: center;">Sem 6 SGPA</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_university }} - {{ $users1[0]->degree_college_name }} - {{$users1[0]->degree_name}} - {{$users1[0]->degree_branch}}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_passing_month }} {{ $users1[0]->degree_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_sem3_sgpa }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_sem4_sgpa }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_sem5_sgpa }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_sem6_sgpa }}</td>
                        </tr>
                        @else
                        <tr>
                           <td id="hide" style="text-align: center;">University & Name of College & Degree & Branch</td>
                           <td id="hide" style="text-align: center;">Month & Year of Passing</td>
                           <td id="hide" style="text-align: center;">Marks Obtained</td>
                           <td id="hide" style="text-align: center;">Maximum Marks</td>
                           <td id="hide" style="text-align: center;">Percentage</td>
                           <td id="hide" style="text-align: center;">C.G.P.A</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_university }} - {{ $users1[0]->degree_college_name }} - {{$users1[0]->degree_name}} - {{$users1[0]->degree_branch}}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_passing_month }} {{ $users1[0]->degree_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_aggr_obt_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_aggr_max_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_percentage }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->degree_final_cgpa }}</td>
                        </tr>
                        <@endif
                        <tr>
                           <th id="brand" colspan="6">Family Details</th>
                        </tr>
                         <tr>
                           <th id="line" colspan="6" style="text-align: center; font-size: 15px;"></th>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Father's/Husband's Name</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_first_name }} {{ $users1[0]->g_middle_name }} {{ $users1[0]->g_last_name }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Mother's Name</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->mother_name }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Father's/Husband's Occupation</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_occupation }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Father's/Husband's&nbsp;Mobile&nbsp;No.</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_mobile }}</td>
                        </tr>
                        <tr>
                           <td id="hide" rowspan="2">&nbsp;&nbsp;&nbsp;Professional Address</td>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_office_address }}</td>
                        </tr>
                        <tr>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_office_address }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Designation</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_occupation }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Qualification</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_qualification }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Parent's/Self<br>&nbsp;&nbsp;&nbsp;Annual Income</td>
                           <td id="data" colspan="5">&nbsp;&nbsp;&nbsp;Rs.{{ $users1[0]->g_annual_income }}/-</td>
                        </tr>
                        <tr>
                           <th id="brand" colspan="6">Declaration by Student</th>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <p align="justify">
                                 <b>
                                 I have read all the rules of admission and on understanding these Rules with respect to D.T.E. & University of Mumbai, I have filled this Application Form for Admission in Masters Of Computer Application of Post Graduate Course for the Academic Year 2019-20. The information given by me in this application is true to the best of my knowledge & belief. If at later stage, it is found that I have furnished wrong information
                                 and/or submitted false certificate(s), I am aware that my admission stands cancelled and fees paid by me will be forfeited. Further I will
                                 be subject to legal and/or penal action as per the provisions of the law.
                                 </b>
                              </p>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right; font-weight: bold;">Date&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="4" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="3" style="text-align: center;">
                              <br><br>
                              <center>Candidate's Signature<br><b>({{ $users1[0]->name_on_marksheet }})</b></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Place&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="4">&nbsp;&nbsp;&nbsp;Mumbai</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Verified By&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="4" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;Name of Staff:<br><br>&nbsp;&nbsp;&nbsp;Signature:</td>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>