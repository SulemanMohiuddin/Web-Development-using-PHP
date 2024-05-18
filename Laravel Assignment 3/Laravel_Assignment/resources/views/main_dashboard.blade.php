<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
                body{
        margin:0px;
        padding:0px;
        font-family:"Roboto",sans-serif;
        }

        header{
        position:fixed;
        background:#22242A;
        padding:20px;
        width:100%;
        height:30px;
        }

        .left_area h3{
        color:#fff;
        margin:0;
        text-transform:uppercase;
        font-size:22px;
        font-weight:900;
        }

        .left_area span{
        color:#1DC4E7;
        }

        .logout_btn{
        padding:5px;
        background:#19B3D3;
        text-decoration:none;
        float:right;
        margin-top:-30px;
        margin-right:40px;
        border-radius:2px;
        font-size:15px;
        font-weight:600;
        color:#fff;
        transition:0.5s;
        transition-property:background;
        }

        .logout_btn:hover{
        background:#0D9DBB;
        }

        .profile-div{
        text-align:center;
        }

        .sidebar{
        background:#2F323A;
        position:fixed;
        left:0;
        width:250px;
        height:100%;
        transition:0.5s;
        transition-property:left;
        }



        .sidebar h4{
        color:#ccc;
        margin-top:0;
        margin-bottom:20px;
        }

        .sidebar a{
        color:#fff;
        display:block;
        width:100%;
        line-height:60px;
        text-decoration:none;
        padding-left:40px;
        box-sizing:border-box;
        transition:0.5s;
        transition-property:background;
        }

        .sidebar a:hover{
        background:#19B3D3;
        }

        .sidebar i{
        padding-right:10px;
        }

        label #sidebar_btn{
        z-index:1;
        color:#fff;
        position:fixed;
        cursor:pointer;
        left:300px;
        font-size:20px;
        margin:5px 0px;
        transition:0.5s;
        transition-property:color;
        }

        label #sidebar_btn:hover{
        color:#19B3D3;
        }

        #check:checked ~ .sidebar{
        left:-190px;
        }

        #check:checked ~ .sidebar a span{
        display:none;
        }

        #check:checked ~.sidebar a{
        font-size:20px;
        margin-left:170px;
        width:80px;
        }

        .content{
        margin-left:250px;
        padding: 100px;
        height:100px;
        transition:0.5s;
        }

        #check:checked ~ .content{
        margin-left:60px;
        }

        #check{
        display:none;
        }

        .profile_image {
    width: 30px;
    height: 30px;
    border-radius: 50%;
        }
        .student-info {
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        .student {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-pic img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .details {
            flex: 1;
        }

        .details p {
            margin: 5px 0;
        }

        .details p strong {
            font-weight: bold;
        }
        .courses {
            margin-top: 20px;
        }

        .courses h2 {
            font-family: Arial, sans-serif;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .courses ul {
            list-style-type: none;
            padding: 0;
        }

        .courses li {
            margin-bottom: 5px;
        }

        .courses li:before {
            content: "•";
            margin-right: 5px;
        }
                
        h1{
        font-size: 30px;
        color: #fff;
        text-transform: uppercase;
        font-weight: 300;
        text-align: center;
        margin-bottom: 15px;
        }
        table{
        width:100%;
        table-layout: fixed;
        }
        .tbl-header{
        background-color: rgba(255,255,255,0.3);
        }
        .tbl-content{
        height:300px;
        overflow-x:auto;
        margin-top: 0px;
        border: 1px solid rgba(255,255,255,0.3);
        }
        th{
        padding: 20px 15px;
        text-align: left;
        font-weight: 500;
        font-size: 12px;
        color: #fff;
        text-transform: uppercase;
        }
        td{
        padding: 15px;
        text-align: left;
        vertical-align:middle;
        font-weight: 300;
        font-size: 12px;
        color: #fff;
        border-bottom: solid 1px rgba(255,255,255,0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{
        background: -webkit-linear-gradient(left, #25c481, #25b7c4);
        background: linear-gradient(to right, #25c481, #25b7c4);
        font-family: 'Roboto', sans-serif;
        }
        section{
        margin: 50px;
        }


        /* follow me template */
        .made-with-love {
            position: relative;
         margin-top: 40px;
        padding: 10px;
        text-align: center;
        font-size: 10px;
        font-family: arial;
        color: black;
        }
        .made-with-love i {
        font-style: normal;
        color: #F50057;
        font-size: 14px;
        position: relative;
        top: 2px;
        }
        .made-with-love a {
        color: #fff;
        text-decoration: none;
        }
        .made-with-love a:hover {
        text-decoration: underline;
        }


        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        }

</style>
</head>
<body>
<header>
    <div class="left_area">
        <h3>University <span>Management System</span></h3>
    </div>

        <div class="right_area">
            
          <button id="logout" class="logout_btn" onclick="logout()">Logout</button></div>
        
        </header>
<div class="content">
    <div class="sidebar">
        @php
            $type = session('type');
        @endphp

        @if(isset($type))
            @if($type == 'admin')
                <div style='margin-top: 50px;'>
                    <button class='made-with-love' id='btn1'>Update/Delete User's</button><br>
                    <button class='made-with-love' id='btn2'>Offer Courses</button><br>
                    <button class='made-with-love' id='btn3'>Assign Course to Faculty</button>
                </div>
            @endif
        @endif
        @yield('sidebar')
    </div>

        <div id="fetch">
            @yield('content')
        </div>
    </div>
</div>
@yield('scripts')
<script>
    function logout(){
        window.location.href="{{route('login')}}";
        session_destroy();
    }
    document.getElementById("btn1").addEventListener('click', function() {
        window.location.href = "{{ route('update') }}";
    });
        document.getElementById("btn2").addEventListener('click', function() {
            window.location.href = "{{ route('offer.course') }}";
        });
        document.getElementById("btn3").addEventListener('click', function() {
            window.location.href = "{{ route('assign.courses') }}";
        });
    </script>
</body>
</html>