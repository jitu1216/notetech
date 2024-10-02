@extends('studentDashboard.layouts.master')
@section('content')
    <style>
        .profile-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>



    <div class="page-wrapper">
        <div class="container">
            <h1 class="text-center mt-4">Topper Student of the Year</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 profile-card">
                    <h2 class="text-center">Student name</h2>
                    <img src="/student-photos/149635.jpg" height="75" width="100" alt="Profile Picture"
                        class="rounded-circle mx-auto d-block" />
                    <p class="text-center"><strong>Grade:</strong> 12</p>
                    <p class="text-center"><strong>GPA:</strong> 4.0</p>
                    <p><strong>Achievements:</strong></p>
                    <ul>
                        <li>First Place in Science Fair</li>
                        <li>National Honor Society Member</li>
                        <li>Varsity Soccer Team Captain</li>
                    </ul>
                    <p><strong>About:</strong> is an exceptional student with a passion for science and
                        mathematics. He is also an active member of the community, volunteering at local shelters.</p>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary">Contact</a>
                        <a href="#" class="btn btn-secondary">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
