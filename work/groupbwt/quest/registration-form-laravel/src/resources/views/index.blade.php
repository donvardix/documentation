@extends('layouts.layout', ['title'=>'Laravel - Registration Form'])

@section('content')
    <div class="text-center">
        <a href="{{ route('all_members') }}">All members (<span id="number">{{ $number }}</span>)</a>
    </div>
    <div id="form1-block" style="{{ $showForm1 }}">
        <form id="form1" action="" method="post">
            @csrf
            <div class="form-group">
                <label for="firstname">First name<span class="text-danger">*</span></label>
                <input id="firstname" class="form-control" name="firstname" type="text"
                       placeholder="Enter First name">
                <span id="firstname-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="lastname">Last name<span class="text-danger">*</span></label>
                <input id="lastname" class="form-control" name="lastname" type="text" placeholder="Enter Last name">
                <span id="lastname-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="birthdate">Birth date<span class="text-danger">*</span></label>
                <input id="birthdate" class="form-control" name="birthdate" type="date" style="color: #6c757d">
                <span id="birthdate-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="reportsubject">Report subject<span class="text-danger">*</span></label>
                <input id="reportsubject" class="form-control" name="reportsubject" type="text"
                       placeholder="Enter Report subject">
                <span id="reportsubject-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="country">Country<span class="text-danger">*</span></label>
                <select id="country" class="custom-select" name="country" style="color: #6c757d">
                    <option value="">Select country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->country }}">{{ $country->country }}</option>
                    @endforeach
                </select>
                <span id="country-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone<span class="text-danger">*</span></label>
                <input id="phone" class="form-control" name="phone" type="text"
                       placeholder="Enter Phone" style="color: #6c757d">
                <input hidden type="checkbox" id="phone_mask" checked>
                <input hidden type="radio" name="mode" id="is_world" value="world" checked>
                <input hidden type="radio" name="mode" id="is_russia" value="ru">
                <span id="phone-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input id="email" class="form-control" name="email" type="text" placeholder="Enter Email">
                <span id="email-error" class="text-danger"></span>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
    <div id="form2-block" style="{{ $showForm2 }}">
        <form id="form2" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="company">Company</label>
                <input id="company" class="form-control" name="company" type="text" placeholder="Enter company">
                <span id="company-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input id="position" name="position" class="form-control" type="text" placeholder="Enter position">
                <span id="position-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="aboutme">About me</label>
                <textarea id="aboutme" name="aboutme" class="form-control" rows="3"></textarea>
                <span id="aboutme-error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input id="photo" name="photo" class="form-control-file" type="file">
                <span id="photo-error" class="text-danger"></span>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
    <div id="form3-block" class="text-center" style="display: none">
        <br><br>
        <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&appId=376418812431772&width=95&height=20"
                width="95" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowTransparency="true" allow="encrypted-media"></iframe>
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="{{ $text }}"
           data-url="{{ $url }}" data-show-count="false">Tweet</a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <br><br>
        <a class="btn btn-primary" href="{{ route('home') }}">Back to home</a>
    </div>
@endsection