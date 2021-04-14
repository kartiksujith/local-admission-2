<!DOCTYPE html>
<html>
   <head>
      <title>{{ "DSE_ACAP_".$users1[0]->name_on_marksheet }}</title>
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
         margin: 0mm -10mm -5mm -10mm;
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
      <div class="container">
         <div class="col-md-12">
            <center>
                <img class="img-responsive" src="{{ asset('images/header_dse_admissionForm.jpg') }}">

            </center>
         </div>
         <div class="col-md-12">
            <div class="form-group">
               <div class="col-md-12">
                  <table>
                     <thead>
                        <tr>
                           <th id="line" colspan="3">DTE ID: {{ $users1[0]->dte_id }}</th>
                           <th id="line" colspan="3"style="text-align: right;">Branch: {{$users1[0]->dte_branch}}</th>
                        </tr>
                        <tr>
                           <th id="brand" colspan="6">Personal Details</th>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Candidate's Name</td>
                           <td id="data" colspan="4">&nbsp;&nbsp;&nbsp;{{ $users1[0]->name_on_marksheet }}</td>
                           <td id="hide" rowspan="6">
                              <center><img src="{{ asset('public/uploads/'.$users1[0]->dte_id.'_'.$users1['hash'].'/'.$users1[0]->photo_path) }}" style="width: 200px; height: 200px;" alt="Missing Image" /></center>
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
                            <td id="hide">&nbsp;&nbsp;&nbsp;Category</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->category }}</td>


                           <td id="hide">&nbsp;&nbsp;&nbsp;Candidature Type</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;Type - {{ $users1[0]->candidate_type }}</td>
                        </tr>
                        <tr>
                           <td id="hide">&nbsp;&nbsp;&nbsp;Type Of Seat</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->seat_type }}</td>
                           <td id="hide">&nbsp;&nbsp;&nbsp;MH-State General<br>&nbsp;&nbsp;&nbsp;Merit No.</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->mh_state_general_merit_no }}</td>


                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                       <tr>
                           <th id="brand" colspan="6">Details of SSC Examination</th>
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
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_board }},{{$users1[0]->x_school_name}},{{$users1[0]->x_school_city}}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_passing_month }} {{ $users1[0]->x_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_obtained_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_max_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->x_percentage }}</td>
                        </tr>

                        <tr>
                           <td id="hide" style="text-align: center;" colspan="2">Mathematics Marks</td>
                           <td id="hide" style="text-align: center;"  colspan="2">Science Marks</td>
                           <td id="hide" style="text-align: center;"  colspan="2">English Marks</td>

                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;  </td>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp; </td>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp; </td>

                        </tr>

                       @if( $users1[0]->is_hsc == "yes" ) 
                        <tr>
                           <th id="brand" colspan="6">Details of HSC Examination</th>
                        </tr>
                        <tr style="margin-top:10px;">
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
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_board }} - {{ $users1[0]->dte_id }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_passing_month }} {{ $users1[0]->xii_passing_year }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_obtained_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_max_marks }}</td>
                           <td id="data" style="text-align: center;">&nbsp;&nbsp;&nbsp;{{ $users1[0]->xii_percentage }}</td>
                        </tr> 
                        @endif
 <tr>
                           <th id="brand" colspan="6">Details of Diploma</th>
                        </tr>

                        <tr>
                           <th id="line" colspan="6" style="text-align: center; font-size: 15px;">Diploma/BSC/Equivalent*</th>
                        </tr>

                          <tr>
                           <td id="hide" style="text-align: center;" colspan="2">College Name</td>
                           <td id="hide" style="text-align: center;"  colspan="2">College City and State</td>
                           <td id="hide" style="text-align: center;"  colspan="2">Passing Month and Year</td>
                           
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_college_name }}  </td>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_college_city }},{{ $users1[0]->diploma_college_state }}  </td>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_passing_month }} {{ $users1[0]->diploma_passing_year}}   </td>
                           
                        </tr>
                         <tr>
                           <td id="hide" style="text-align: center;" colspan="2">College University Name</td>
                           <td id="hide" style="text-align: center;"  colspan="2">Branch Name</td>
                           <td id="hide" style="text-align: center;"  colspan="2">Seat Number</td>
                           
                        </tr>
                        <tr>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_university  }}  </td>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_branch }}  </td>
                           <td id="data" style="text-align: center;" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_seat_no }}     </td>
                           
                        </tr>

                        <tr>
                           <td id="hide" style="text-align: center;" colspan="2"  >Aggregate Obtained Marks</td>
                           <td id="hide" style="text-align: center;" colspan="2"  >Aggregate Total Marks</td>
                           <td id="hide" style="text-align: center;"  colspan="2" >Percentage</td>
                           <!-- <td id="hide" style="text-align: center;" >Sem I maximum marks</td>
                           <td id="hide" style="text-align: center;"   >Sem I obtained marks</td>
                           <td id="hide" style="text-align: center;"   >Sem II maximum marks</td>
                           <td id="hide" style="text-align: center;"   > Sem II obtained marks</td>
                           <td id="hide" style="text-align: center;"   >Sem III maximum marks</td>
                           <td id="hide" style="text-align: center;"   > Sem III obtained marks</td> -->
                        </tr>
                         <tr>
                           <td id="data" style="text-align: center;" colspan="2"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_aggr_obt_sem6 }}  </td>
                           <td id="data" style="text-align: center;" colspan="2" >&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_aggr_max_sem6 }}  </td>
                           <td id="data" style="text-align: center;" colspan="2" >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_aggr_percent_sem6 }}     </td>
                           <!-- <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks_sem1 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_obt_marks_sem1 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks_sem2 }}     </td>
                             <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_obt_marks_sem2 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_max_marks_sem3 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_obt_marks_sem3 }}     </td> -->
                        </tr>

                        <!-- <tr>
                           <td id="hide" style="text-align: center;" >Sem IV maximum marks</td>
                           <td id="hide" style="text-align: center;"   >Sem IV obtained marks</td>
                           <td id="hide" style="text-align: center;"   >Sem V maximum marks</td>
                           <td id="hide" style="text-align: center;"   > Sem V obtained marks</td>
                           <td id="hide" style="text-align: center;"   >Sem VI maximum marks</td>
                           <td id="hide" style="text-align: center;"   > Sem VI obtained marks</td>
                        </tr>
                         <tr>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks_sem4 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_obt_marks_sem4 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks_sem5 }}     </td>
                             <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_obt_marks_sem5 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_max_marks_sem6 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_obt_marks_sem6 }}     </td>
                        </tr> -->
                         @if( $users1[0]->is_four_year == "yes" ) 
                            <tr>
                           <td id="hide" style="text-align: center;" >Sem VII maximum marks</td>
                           <td id="hide" style="text-align: center;"   >Sem VII obtained marks</td>
                           <td id="hide" style="text-align: center;"   >Sem VIII maximum marks</td>
                           <td id="hide" style="text-align: center;"   > Sem VIII obtained marks</td>
                           
                        </tr>
                         <tr>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks_sem7 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp; {{ $users1[0]->diploma_obt_marks_sem7 }}  </td>
                           <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_max_marks_sem8 }}     </td>
                             <td id="data" style="text-align: center;"  >&nbsp;&nbsp;&nbsp;{{ $users1[0]->diploma_obt_marks_sem8 }}  </td>
                           
                        </tr>
                        @endif
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
                           <td id="data" colspan="6">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_office_address }}</td>
                        </tr>
                        <tr>
                           <!-- <td id="hide">&nbsp;&nbsp;&nbsp;Designation</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_occupation }}</td> -->
                           
                           <td id="hide">&nbsp;&nbsp;&nbsp;Qualification</td>
                           <td id="data" colspan="2">&nbsp;&nbsp;&nbsp;{{ $users1[0]->g_qualification }}</td>
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
                                 I have read all the rules of admission and on understanding these Rules with respect to D.T.E. & University of Mumbai, I have filled this Application Form for Admission to First
                                 Year of Under Graduate  Courses in Direct Second Year Bachelor of Engineering for the Academic Year 2019-20 . The information given by me in this application is true to the best of my knowledge & belief. If at later stage, it is found that I have furnished wrong information
                                 and/or submitted false certificate(s), I am aware that my admission stands cancelled and fees paid by me will be forfeited. Further I will
                                 be subject to legal and/or penal action as per the provisions of the law.
                                 </b>
                              </p>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right; font-weight: bold;">Date&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="3"colspan="4" style="text-align: center;">
                              <br><br><br><br>
                              <center>Candidate's Signature<br><b>({{ $users1[0]->name_on_marksheet }})</b></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Place&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="3" >&nbsp;&nbsp;&nbsp;Mumbai</td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Verified By&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;Name of Staff:<br><br>&nbsp;&nbsp;&nbsp;Signature:</td>
                        </tr>
                     </thead>
                  </table>

                  <!----------------------------Page 2 -------------------------------------->
                  <div class="col-md-12" style="page-break-before: always;">
                     <center><img class="img-responsive" src="{{ asset('images/header_dse_admissionForm.jpg') }}"></center>
                  </div>
                  <table style="margin-top:-9px;">
                     <thead>
                        <tr>
                           <th id="line" style="text-align: center; font-size: 25px;" colspan="6">UNDERTAKING</th>
                        </tr>
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold; text-align: right;">Date&nbsp;&nbsp;&nbsp;{{  $users1['date'] }}</td>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <p>
                                 I, Mr./Miss. <b>{{ $users1[0]->name_on_marksheet }}</b> have taken admission in this Institution in Direct Second Year Bachelor of Engineering in the <b>{{$users1['shift_allotted']}}</b> Shift, on my own, in consultation with my parents. I assure you that I will abide by all rules and regulation laid down by the Management of this Institution,Directorate of Technical Education (M.S.), University of Mumbai issued from time to time. In the event of failure of these, I shall render myself for disciplinary action including expulsion from the Institute.
                              </p>
                              <p align="justify">I have read all the Rules of Admission for the year and after fully understanding all the rules, I have filled in this application form for admission to Direct second year of Bachelor of Engineering  for the current academic year.</p>
                              <p align="justify">I have not been debarred from appearing at any examination held by any Government constituted or Statutory Examination Authority in India.</p>
                              <p align="justify">I understand that no other document, other than those attached to the application form before the last date of admission will be entertained for the purpose of claims/concessions etc. in connection with my admission.</p>
                              <p align="justify">I hereby agree to confirm to any rules, acts and laws enforced by Government including Anti-Ragging Act and will not indulge in any anti-national activities. I also hereby undertake that so long as I am a student of the institute, I will do nothing either inside or outside the institute, which may result in disciplinary action against me under the rules, acts and laws.</p>
                              <p align="justify">I shall not claim for any kind of financial assistance and help from this Institution for my education.</p>
                              <p align="justify">I am fully aware that the above Institute is going to charge higher fees for different courses at different levels, as decided by the Government, and I hereby agree to pay such enhance fees.</p>
                              <p align="justify">I am fully aware that, I will not be allowed to keep term and appear for the examination if I do not attend minimum 75% classes of theory, practical, tutorials etc. I am also aware that I will not be allowed to appear for the examination, if I fail to submit satisfactory all the assignment, jobs, journals, reports, etc. as specified by the university within stipulated time.</p>
                              <p align="justify">I hereby solemnly affirm that I shall attend the classes and do practical in laboratories, Workshops etc., faithfully and diligently and shall follow in letter and spirit, the safety precautions instructed by the teaching faculty members, in the course of my studies, and that the above named institute will not be held responsible for my negligence towards safety precautions.</p>
                              <p align="justify">I further assure that I shall not damage any furniture, equipment and other property of the Institute, and if damaged, I hereby undertake to make good the loss/ damage and/ or I am liable for such disciplinary action, as deemed suitable by authorities.</p>
                              <p align="justify">Admission will stand cancelled, if at any time, any of the document or certificate is found to be invalid or fraudulent and / or the candidate does not meet the eligibility norms.</p>
                              <p align="justify">The information given by me in the application is true to the best of my knowledge and belief.</p>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;">Date&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="2"colspan="4" style="text-align: center;">
                              <br><br><br><br>
                              <center>Candidate's Signature<br><b>({{ $users1[0]->name_on_marksheet }})</b></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;">Place&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="3">&nbsp;&nbsp;&nbsp;Mumbai</td>
                        </tr>
                     </thead>
                  </table>

                  <!----------------------------------Page 3------------------------------>
                  <div style="page-break-before: always;"></div>
                  <div class="col-md-12">
                     <center><img class="img-responsive" src="{{ asset('images/header_dse_admissionForm.jpg') }}"></center>
                  </div>
                  <table>
                     <thead>
                        <tr>
                           <th id="line" style="text-align: center; font-size: 25px;" colspan="6">UNDERTAKING</th>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <p>I Mr./Miss. <b>{{ $users1[0]->name_on_marksheet }}</b> hereby declare that I am taking admission to the Direct Second Year Bachelor of Engineering Course <b>{{ $users1['shift_allotted'] }}</b> branch for the Academic Year: <span><b>2019-20 </b></span> in V.E.S Institute of Technology, Chembur-74.</p>
                              <p>I am not submitting the following Original Documents at the time of the above said Admission:</p>
                           </td>
                        </tr>
                        @if( $users1[0]->photo == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img class="img-responsive" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Profile Photo</td>
                        </tr>
                        @endif
                        @if( $users1[0]->signature == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img class="img-responsive" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Signature</td>
                        </tr>
                        @endif
                        @if( $users1[0]->fc_confirmation_receipt == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;FC Confirmation Receipt</td>
                        </tr>
                        @endif


                        @if( $users1[0]->ssc_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;SSC Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->hsc_diploma_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;HSC Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->first_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma First Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->second_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma Second Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->third_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma Third Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->fourth_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma fourth Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->convocation_passing_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Convocation/passing Certificate</td>
                        </tr>
                        @endif

                        @if( $users1[0]->equivalent_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Equivalent Certificate</td>
                        </tr>
                        @endif


                        @if( $users1[0]->degree_leaving_tc == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma Leaving Certificate</td>
                        </tr>
                        @endif




                        @if( $users1[0]->birth_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Birth Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->domicile == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Domicile Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->proforma_o == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Proforma O</td>
                        </tr>
                        @endif
                        @if( $users1[0]->retention == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Retention Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->minority_affidavit == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Minority Affidavit</td>
                        </tr>
                        @endif

                        @if( $users1[0]->community_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Community Certificate</td>
                        </tr>
                        @endif


                        @if( $users1[0]->nationality_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;"><img  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Nationality Certificate</td>
                        </tr>
                        @endif




                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="6" id="line">
                              <p>
                                 I do understand that the original of above mentioned certificate/s are required for approval for my admission by DTE & Mumbai University.
                                 I undertake that I will be responsible for submission of the above documents within four working days including the day of admission, failing which my provisional admission stands cancel as per DTE rules & I further state that I will not hold college responsible for any such consequences and if my seat falls vacant due to my ineligibility/non submission of documents, I will abide by DTE rules for refund of Fees.
                              </p>
                           </td>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                       <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Date&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="2" colspan="4" style="text-align: center;">
                              <br><br><br><br>
                              <center>Candidate's Signature<br><b>({{ $users1[0]->name_on_marksheet }})</b></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Place&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="3">&nbsp;&nbsp;&nbsp;Mumbai</td>
                        </tr>
                     </thead>
                  </table>
                  <!-------------------------------------------Page 4-------------------------------------------------->
                  <div style="page-break-before: always;"></div>
                  <div class="col-md-12">
                     <center><img class="img-responsive" src="{{ asset('images/header_dse_admissionForm.jpg') }}"></center>
                  </div>
                  <table>
                     <thead>
                        <tr>
                           <th id="line" style="text-align: center; font-size: 25px;" colspan="6">DOCUMENT DECLARATION (COLLEGE COPY)</th>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <p align="justify">
                                 I Mr./Miss. <b>{{ $users1[0]->name_on_marksheet }}</b> hereby declare that I am taking admission to the Direct Second Year Bachelor of Engineering.
                                 In <b>{{ $users1['shift_allotted'] }}</b> Shift for the Academic Year: 2019-20  in V.E.S Institute of Technology,
                                 Chembur-74.
                              </p>
                              <p>The following original certificates of the student have been retained with the institue for the admission purpose.</p>
                           </td>
                        </tr>



                         @if( $users1[0]->fc_confirmation_receipt == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;FC Confirmation Receipt</td>
                        </tr>
                        @endif
                        @if( $users1[0]->ssc_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;SSC Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->hsc_diploma_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;HSC / Diploma Marksheet</td>
                        </tr>
                        @endif
                         @if( $users1[0]->first_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;First Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->second_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Second Year Marksheet</td>
                        </tr>
                        @endif

                        @if( $users1[0]->fourth_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Third Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->convocation_passing_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Convocation/Passing Certificate</td>
                        </tr>
                        @endif

                         @if( $users1[0]->equivalent_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Retention Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->degree_leaving_tc == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Minority Affidavit</td>
                        </tr>
                        @endif
                        @if( $users1[0]->birth_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Birth Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->domicile == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Domicile Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->proforma_o == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Proforma O</td>
                        </tr>
                        @endif
                        @if( $users1[0]->retention == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Retention Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->minority_affidavit == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Minority Affidavit</td>
                        </tr>
                        @endif

                        @if( $users1[0]->community_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Community Certificate</td>
                        </tr>
                        @endif

                         @if( $users1[0]->nationality_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%">&nbsp;Community Certificate</td>
                        </tr>
                        @endif

                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                       <tr>
                           <td id="data" style="text-align: right;">Date&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="2" colspan="4" style="text-align: center;">
                              <br><br><br><br>
                              <center>Candidate's Signature<br><b>({{ $users1[0]->name_on_marksheet }})</b></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;">Place&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="3">&nbsp;&nbsp;&nbsp;Mumbai</td>
                        </tr>
                     </thead>
                  </table>
                  <!-------------------------------------------Page 5-------------------------------------------------->
                  <div style="page-break-before: always;"></div>
                  <div class="col-md-12">
                     <center><img class="img-responsive" src="{{ asset('images/header_dse_admissionForm.jpg') }}"></center>
                  </div>
                  <table>
                     <thead>
                        <tr>
                           <th id="line" style="text-align: center; font-size: 25px;" colspan="6">UNDERTAKING</th>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <p>I Mr./Miss. <b>{{ $users1[0]->name_on_marksheet }}</b> hereby declare that I am taking admission to the Direct Second Year Bachelor of Engineering  <b>{{ $users1[0]->shift_allotted }} Shift</b> for the Academic Year: <b>2019-20 </b> in V.E.S Institute of Technology, Chembur-74.</p>
                              <p>I am not submitting the following Original Documents at the time of the above said Admission:</p>
                           </td>
                        </tr>
                        @if( $users1[0]->photo == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive"style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Profile Photo</td>
                        </tr>
                        @endif
                        @if( $users1[0]->signature == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Signature</td>
                        </tr>
                        @endif
                        @if( $users1[0]->fc_confirmation_receipt == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"src="{{ asset('images/glyphicon-remove.png') }} " height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;FC Confirmation Receipt</td>
                        </tr>
                        @endif
                        @if( $users1[0]->ssc_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;SSC Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->hsc_diploma_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;HSC Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->first_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img  class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%"ss>&nbsp;&nbsp;&nbsp;Diploma First Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->second_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma Second Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->third_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma Third Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->fourth_year_marksheet == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma fourth Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->convocation_passing_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Convocation/passing Certificate</td>
                        </tr>
                        @endif

                        @if( $users1[0]->equivalent_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;"  src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Equivalent Certificate</td>
                        </tr>
                        @endif


                        @if( $users1[0]->degree_leaving_tc == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Diploma Leaving Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->birth_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Birth Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->domicile == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Domicile Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->proforma_o == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Proforma O</td>
                        </tr>
                        @endif
                        @if( $users1[0]->retention == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Retention Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->minority_affidavit == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Minority Affidavit</td>
                        </tr>
                        @endif

                        @if( $users1[0]->community_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Community Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->nationality_certi == 'No')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:12px;"><img class="img-responsive" style="height:10px;" src="{{ asset('images/glyphicon-remove.png') }}" height="15px" min-width="100%">&nbsp;&nbsp;&nbsp;Nationality Certificate</td>
                        </tr>
                        @endif
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="6" id="line">
                              <p>
                                 I do understand that the original of above mentioned certificate/s are required for approval for my admission by DTE & Mumbai University.
                                 I undertake that I will be responsible for submission of the above documents within four working days including the day of admission, failing which my provisional admission stands cancel as per DTE rules & I further state that I will not hold college responsible for any such consequences and if my seat falls vacant due to my ineligibility/non submission of documents, I will abide by DTE rules for refund of Fees.
                              </p>
                           </td>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                       <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Date&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="2" colspan="4" style="text-align: center;">
                              <br><br><br><br>
                              <center>Candidate's Signature<br><b>({{ $users1[0]->name_on_marksheet }})</b></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;font-weight: bold;">Place&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="3">&nbsp;Mumbai</td>
                        </tr>

                     </thead>
                  </table>
                  
                  <div style="page-break-before: always;"></div>
                  <div class="col-md-12">
                     <center><img   src="{{ asset('images/header_dse_admissionForm.jpg') }}"></center>
                  </div>
                       <table>
                     <thead>
                        <tr>
                           <th id="line" style="text-align: center; font-size: 25px;" colspan="6">RETENTION CERTIFICATE</th>
                        </tr>
                        <tr>
                           <td id="line" colspan="6">
                              <p align="justify">
                                 I Mr./Miss. <b>{{ $users1[0]->name_on_marksheet }}</b> hereby declare that I am taking admission to the Direct Second Year Bachelor of Engineering.
                                 In <b>{{ $users1['shift_allotted'] }}</b> Shift for the Academic Year: 2019-20  in V.E.S Institute of Technology,
                                 Chembur-74.
                              </p>
                              <p>The following original certificates of the student have been retained with the institue for the admission purpose.</p>
                           </td>
                        </tr>
                        @if( $users1[0]->fc_confirmation_receipt == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"  src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;FC Confirmation Receipt</td>
                        </tr>
                         @endif
                        @if( $users1[0]->dte_allotment_letter == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;DTE Allotment Letter</td>
                        </tr>
                        @endif
                        @if( $users1[0]->arc_ackw_receipt == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;ARC Acknowledgement</td>
                        </tr>
                        @endif
                        
                        @if( $users1[0]->ssc_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;SSC Marksheet</td>
                        </tr>
                        @endif
                        
                        @if( $users1[0]->hsc_diploma_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;HSC Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->first_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Diploma First Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->second_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Diploma Second Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->third_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Diploma Third Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->fourth_year_marksheet == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Diploma fourth Year Marksheet</td>
                        </tr>
                        @endif
                        @if( $users1[0]->convocation_passing_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Convocation/passing Certificate</td>
                        </tr>
                        @endif

                        @if( $users1[0]->equivalent_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Equivalent Certificate</td>
                        </tr>
                        @endif
                           

                        @if( $users1[0]->degree_leaving_tc == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Diploma Leaving Certificate</td>
                        </tr>
                        @endif 
                         
                        @if( $users1[0]->migration_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Migration Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->birth_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Birth Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->domicile == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Domicile Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->proforma_o == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Proforma O</td>
                        </tr>
                        @endif
                        @if( $users1[0]->retention == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Retention Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->minority_affidavit == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Minority Affidavit</td>
                        </tr>
                        @endif
                        @if( $users1[0]->gap_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Gap Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->community_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Community Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->caste_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Caste Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->caste_validity_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Caste Validity Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->non_creamy_layer_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Non-Creamy Layer Certificate</td>
                        </tr>
                        @endif
                         @if( $users1[0]->income_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Income Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->nationality_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Nationality Certificate</td>
                        </tr>
                        @endif
                        
                        @if( $users1[0]->proforma_c_d_e == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Proforma C D E</td>
                        </tr>
                        @endif
                        
                        @if( $users1[0]->medical_certi == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Physical Fitness Certificate</td>
                        </tr>
                        @endif
                        @if( $users1[0]->anti_ragging_affidavit == 'Yes')
                        <tr>
                           <td id="line" colspan="6" style="font-weight: bold;font-size:10px;"><img class="img-responsive"style="height:10px;"   src="{{ asset('images/glyphicon-ok.jpg') }}" height="15px" min-width="100%" >&nbsp;&nbsp;&nbsp;Anti Ragging Certificate</td>
                        </tr>
                        @endif
                        <tr>
                           <td id="line" colspan="6">
                              <br>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;">Date&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" colspan="3" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;{{  $users1['date'] }}</td>
                           <td id="data" rowspan="2" colspan="4" style="text-align: center;">
                              <br><br><br><br>
                              <center>Admission Incharge<br></center>
                           </td>
                        </tr>
                        <tr>
                           <td id="data" style="text-align: right;">Place&nbsp;&nbsp;&nbsp;</td>
                           <td id="data" style="font-weight: bold;" colspan="3">&nbsp;&nbsp;&nbsp;Mumbai</td>
                        </tr>
                     </thead>
                  </table>
                       <!--  <table class="footerposition" cellspacing="10">
                   <tr style= "height:200px;">
                      <td style="border-radius:15px;border:2px solid black;padding: 5px;">
                        <div style="width: 340px;">
                        <div style="border-radius:15px;margin-top:-90px;" height="1"><img style="width:340px;height:30px; border-radius:20px;" src="{{ asset('images/id.JPG') }}"></div>
                            <img align="left" src="{{ asset('public/uploads/'.$users1[0]->dte_id.'_'.$users1['hash'].'/'.$users1[0]->photo_path) }}" style="height: 70px; margin-top:50px;" alt="Missing Image" width="60px" max-width="100%"/>
                     </div>
                     <br>
                <div style="float:left;">
                    <p style="font-size:12px; margin-top:2px; margin-left:80px"><b><br>Provisional ID-Card</b></font></p>
                    <p style="font-size:10px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;ADMISSION YEAR 2019-2020</b></p>
                    <p style=" margin-top:-5px;"><b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;NAME:</b> {{ $users1[0]->last_name }} {{ $users1[0]->first_name }} {{$users1[0]->middle_name}}</p>
                    <p style=" margin-top:-5px;"><b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;D.O.B:</b>{{ $users1[0]->date_of_birth}}<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.Group:{{$users1[0]->blood_group}}</b></p>
                    <p style=" margin-top:-5px;"><b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;LIB CARD NO:</b></p>
                    <p style=" margin-top:5px;"><b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;BE:{{$users1[0]->dte_branch}}</b></p>
                    <div style="margin-left:185px;"><img style="height:50px;margin-top:-30px;" max-width="100%" src="{{ asset('images/asmasign.jpg') }}"></div>
                    <p style="margin-left:190px; margin-top:20px;"><b style="font-size:10px;">Admission In-charge</b></p>
                </div>
                      </td>
                      <td style="float:right;text-align:left;width: 340px;border-radius:15px;border:2px solid black;padding: 5px;">
                         <div>
                        <p style="text-align:left;"><font size="1"><b>&nbsp;Residential Address:</b>{{$users1[0]->permanent_address_line1}},&nbsp;{{$users1[0]->permanent_address_line2}}.</font></p>
                        <font size="1"align="left"><b>&nbsp;Contact No: {{ $users1['mobile']}}</b></font><br>
                        <font size="1"align="left"><b>&nbsp;E-mail ID: {{$users1['email']}}</b></font><br>
                        <font size="1"align="left"><b>&nbsp;INSTRUCTIONS:</b></font><br>
                        <div style="text-align: left;">
                        <font size="0">1.It is mandatory to wear the id card inside the campus and also when required.</font><br>
                        <font size="0">2.In case of loss, the students must inform the principal immediately in writing.</font><br>
                        <font size="0">3.Duplicate ID card will be issued at payment of Rs.250.</font><br>
                        <font size="0">4.This card should be surrendered on completion of engineering for obtaining leaving &nbsp;&nbsp;certificate.</font>
                        </div>
                        <div class="style3">
                        <font size="2"><b style="text-align: center"><center>Validity of the card:DEC-2019</center></b></font>
                        </div>
                        </div> 
                      </td>
                   </tr>
               </table> -->
               </footer>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>