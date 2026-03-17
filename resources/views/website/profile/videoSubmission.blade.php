 <section class="container">
        <!-- Stages Tabs -->


        @php
            $contestant = auth()->user()->contestant; // لو اليوزر مربوط ب Contestant
            $stage1Win = $contestant?->contestantStageReview()->where('stage_number', 1)->where('is_winner', 1)->exists();
            $stage2Win = $contestant?->contestantStageReview()->where('stage_number', 2)->where('is_winner', 1)->exists();
            $stage3Win = $contestant?->contestantStageReview()->where('stage_number', 3)->where('is_winner', 1)->exists();
        @endphp
        <div class="mb-4">
        <ul class="nav nav-tabs stage-tabs w-100 gap-4" id="stageTabs" role="tablist">

            <!-- Stage 1 Always Open -->
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link active w-100" id="stage1-tab" data-bs-toggle="tab" data-bs-target="#stage1" type="button" role="tab">
                    {{__('profile.Stage 1')}}
                </button>
            </li>

            <!-- Stage 2: Requires win of Stage 1 -->
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 {{ $stage1Win ? '' : 'disabled' }}"
                        {{ $stage1Win ? '' : 'style=pointer-events:none;opacity:0.4;' }}
                        id="stage2-tab" data-bs-toggle="tab" data-bs-target="#stage2" type="button" role="tab">
                    {{__('profile.Stage 2')}}
                </button>
            </li>

            <!-- Stage 3: Requires win of Stage 2 -->
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 {{ $stage2Win ? '' : 'disabled' }}"
                        {{ $stage2Win ? '' : 'style=pointer-events:none;opacity:0.4;' }}
                        id="stage3-tab" data-bs-toggle="tab" data-bs-target="#stage3" type="button" role="tab">
                    {{__('profile.Stage 3')}}
                </button>
            </li>

            <!-- Stage 4: Requires win of Stage 3 -->
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 {{ $stage3Win ? '' : 'disabled' }}"
                        {{ $stage3Win ? '' : 'style=pointer-events:none;opacity:0.4;' }}
                        id="stage4-tab" data-bs-toggle="tab" data-bs-target="#stage4" type="button" role="tab">
                    {{__('profile.Stage 4')}}
                </button>
            </li>
        </ul>
    </div>


        <div class="tab-content" id="stageTabsContent">
            <div class="tab-pane fade show active" id="stage1" role="tabpanel" aria-labelledby="stage1-tab">
                <!-- Tabs Content -->
                <div class="row align-items-center g-4 mt-5">
                @php
                    $stage = 1;
                    $data = $uploadedCounts[$stage];
                    
                    
                    $videos = $contestant->videos->where('stage_number', $stage);
                @endphp

                    <div class="col-12 mb-3">
                        <div class="text-center mb-2" style="font-weight: 600;">
                            {{__('profile.Videos for Stage')}} {{ $stage }}
                        </div>

                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <span class="badge bg-secondary px-3 py-2">{{__('profile.Required')}}: {{ $data['required'] }}</span>
                            <span class="badge bg-secondary px-3 py-2">{{__('profile.Uploaded')}}: {{ $data['uploaded'] }}</span>
                            <span class="badge bg-secondary px-3 py-2">{{__('profile.Remaining')}}: {{ $data['remaining'] }}</span>
                        </div>
                    </div>


               @php
                    $introVideo = $contestant->videos->where('type', 'intro')->first();
                
                    function convertToEmbed($url) {
                        if (!$url) return null;
                
                        // إزالة أي باراميتر بعد الفيديو (سواء ? أو & أو أي شيء)
                        $cleanUrl = preg_replace('/([&?].*)$/', '', trim($url));
                
                        // لو الرابط قصير youtu.be
                        if (str_contains($cleanUrl, 'youtu.be/')) {
                            $videoId = substr($cleanUrl, strpos($cleanUrl, 'youtu.be/') + 9);
                            return "https://www.youtube-nocookie.com/embed/" . $videoId;
                        }
                
                        // لو watch?v=
                        if (str_contains($cleanUrl, 'watch?v=')) {
                            $videoId = substr($cleanUrl, strpos($cleanUrl, 'watch?v=') + 8);
                            return "https://www.youtube-nocookie.com/embed/" . $videoId;
                        }
                
                        // لو embed موجود بالفعل
                        if (str_contains($cleanUrl, 'embed/')) {
                            return str_replace("youtube.com", "youtube-nocookie.com", $cleanUrl);
                        }
                
                        // fallback: رجّع الرابط نفسه
                        return $url;
                    }
                @endphp


                    @if($introVideo)
                        <div class="col-12 col-md-6">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="{{ convertToEmbed($introVideo->youtube_url) }}"
                                        title="Intro Video"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen>
                                    </iframe>

                                </div>
                            </div>

                            <p class="mt-4 text-center" style="font-size: 15px; font-family: 'NowM', sans-serif">
                                {{__('profile.Introductory Video')}}
                            </p>
                        </div>
                    @else
                        <div class="col-12 col-md-6">
                            <p class="text-center mt-3" style="font-size: 15px; font-family: 'NowM', sans-serif; color:#999;">
                                لا يوجد فيديو تعريفي (Intro) حتى الآن
                            </p>
                        </div>
                    @endif


                    {{-- ✅ الفورم يظهر فقط إذا المتسابق لم يصل للحد المطلوب --}}
                    @if($data['remaining'] > 0)
                        <div class="col-12 col-md-12">
                            <div class="card p-4 border-0">
                    
                                {{-- رسائل النجاح / الخطأ --}}
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                    
                                <form id="uploadVideoForm"
                                    action="{{ route('contestant.videos.upload') }}"
                                    method="POST"
                                    enctype="multipart/form-data">
                    
                                    @csrf
                    
                                    <!-- Developer Select -->
                                    <div class="mb-3">
                                        <select class="form-select developerSelect" id="developerSelect" required>
                                            <option selected disabled value="">{{__('profile.Select Developer')}}</option>
                                            @foreach($developers as $developer)
                                                <option value="{{ $developer->id }}">{{ $developer->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <!-- Projects Select -->
                                    <div class="mb-3">
                                        <select class="form-select projectsSelect" name="project_id" id="projectsSelect" required disabled>
                                            <option selected disabled value="">{{__('profile.Select Project')}}</option>
                                        </select>
                                    </div>
                    
                                    <!-- Upload Videos -->
                                    <div class="mb-3">
                                        <div class="upload-box">
                                            <div class="upload-text" id="videoUploadLabel">
                                                <i class="fas fa-upload"></i> {{__('profileUpload Video.')}}
                                            </div>
                                            <input type="file" class="videoInput" id="videoInput" name="video_files[]" accept="video/*" multiple required>
                                        </div>
                    
                                        <small id="selectedVideosInfo" class="text-muted mt-2 d-block selectedVideosInfo"></small>
                                    </div>
                    
                                    <input type="hidden" name="stage_number" value="{{ $stage_number ?? 1 }}">
                    
                                    <button type="submit" class="btn btn-dark w-100">{{__('profile.Submit')}}</button>
                                </form>
                            </div>
                        </div>
                    
                    @else
                        {{-- ✅ عرض الفيديوهات بعد الوصول للحد المطلوب --}}
                        @foreach($videos as $video)
                            <div class="col-12 col-md-6 mb-5">
                                <div class="card border-0 cartSt">
                                    <div class="ratio ratio-16x9">
                                        <iframe
                                            src="{{ convertToEmbed($video->youtube_url) }}"
                                            title="Video"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>



           <div class="tab-pane fade show" id="stage2" role="tabpanel" aria-labelledby="stage2-tab">
            <div class="row align-items-center g-4 mt-5">

                @php
                    $stage = 2;
                    $data = $uploadedCounts[$stage];
                    $videos = $contestant->videos->where('stage_number', $stage);
                @endphp

                {{-- عرض العداد أعلى --}}
                <div class="col-12 mb-3">
                    <div class="text-center mb-2" style="font-weight: 600;">
                        {{__('profile.Videos for Stage')}} {{ $stage }}
                    </div>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge bg-secondary px-3 py-2">{{__('profile.Required')}}: {{ $data['required'] }}</span>
                        <span class="badge bg-secondary px-3 py-2">{{__('profile.Uploaded')}}: {{ $data['uploaded'] }}</span>
                        <span class="badge bg-secondary px-3 py-2">{{__('profile.Remaining')}}: {{ $data['remaining'] }}</span>
                    </div>
                </div>

                {{-- ✅ إذا وصل عدد الفيديوهات المطلوب → اخفاء الفورم واظهار الفيديوهات --}}
                @if($data['remaining'] > 0)

                    <!-- ✅ الفورم يظهر فقط إذا المتسابق لسه ماوصلش الحد المطلوب -->
                    <div class="col-12 col-md-12">
                        <div class="card p-4 border-0">

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form id="uploadVideoForm"
                                action="{{ route('contestant.videos.upload') }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <!-- Developer Select -->
                                <div class="mb-3">
                                    <select class="form-select developerSelect" id="developerSelect" required>
                                        <option selected disabled value="">{{__('profile.Select Developer')}}</option>
                                        @foreach($developers as $developer)
                                            <option value="{{ $developer->id }}">{{ $developer->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Projects Select -->
                                <div class="mb-3">
                                    <select class="form-select projectsSelect" name="project_id" id="projectsSelect" required disabled>
                                        <option selected disabled value="">{{__('profile.Select Project')}}</option>
                                    </select>
                                </div>

                                <!-- Upload Videos -->
                                <div class="mb-3">
                                    <div class="upload-box">
                                        <div class="upload-text" id="videoUploadLabel">
                                            <i class="fas fa-upload"></i> {{__('profileUpload Video.')}}
                                        </div>
                                        <input type="file" class="videoInput" id="videoInput" name="video_files[]" accept="video/*" multiple required>
                                    </div>

                                    <small id="selectedVideosInfo" class="text-muted mt-2 d-block selectedVideosInfo"></small>
                                </div>

                                <input type="hidden" name="stage_number" value="2">

                                <button type="submit" class="btn btn-dark w-100">{{__('profile.Submit')}}</button>
                            </form>
                        </div>
                    </div>

                @else

                    <!-- ✅ عرض الفيديوهات بعد الوصول للحد المطلوب -->
                     @foreach($videos as $video)
                            <div class="col-12 col-md-6">
                                <div class="card border-0 cartSt">
                                    <div class="ratio ratio-16x9">
                                        <iframe
                                            src="{{ convertToEmbed($video->youtube_url) }}"
                                            title="Video"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                @endif
            </div>
        </div>



            <div class="tab-pane fade show" id="stage3" role="tabpanel" aria-labelledby="stage3-tab">
                <div class="row align-items-center g-4 mt-5">

                    @php
                        $stage = 3;
                        $data = $uploadedCounts[$stage];
                        $videos = $contestant->videos->where('stage_number', $stage);
                    @endphp

                    {{-- عرض العداد أعلى --}}
                    <div class="col-12 mb-3">
                        <div class="text-center mb-2" style="font-weight: 600;">
                            {{__('profile.Videos for Stage')}} {{ $stage }}
                        </div>

                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <span class="badge bg-secondary px-3 py-2">{{__('profile.Required')}}: {{ $data['required'] }}</span>
                            <span class="badge bg-secondary px-3 py-2">{{__('profile.Uploaded')}}: {{ $data['uploaded'] }}</span>
                            <span class="badge bg-secondary px-3 py-2">{{__('profile.Remaining')}}: {{ $data['remaining'] }}</span>
                        </div>
                    </div>

                    {{-- ✅ إذا وصل عدد الفيديوهات المطلوب → اخفاء الفورم واظهار الفيديوهات --}}
                    @if($data['remaining'] > 0)

                        <!-- ✅ الفورم يظهر فقط إذا المتسابق لسه ماوصلش الحد المطلوب -->
                        <div class="col-12 col-md-12">
                            <div class="card p-4 border-0">

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form id="uploadVideoForm"
                                    action="{{ route('contestant.videos.upload') }}"
                                    method="POST"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <!-- Developer Select -->
                                    <div class="mb-3">
                                        <select class="form-select developerSelect" id="developerSelect" required>
                                            <option selected disabled value="">{{__('profile.Select Developer')}}</option>
                                            @foreach($developers as $developer)
                                                <option value="{{ $developer->id }}">{{ $developer->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Projects Select -->
                                    <div class="mb-3">
                                        <select class="form-select projectsSelect" name="project_id" id="projectsSelect" required disabled>
                                            <option selected disabled value="">{{__('profile.Select Project')}}</option>
                                        </select>
                                    </div>

                                    <!-- Upload Videos -->
                                    <div class="mb-3">
                                        <div class="upload-box">
                                            <div class="upload-text" id="videoUploadLabel">
                                                <i class="fas fa-upload"></i> {{__('profileUpload Video.')}}
                                            </div>
                                            <input type="file" class="videoInput" id="videoInput" name="video_files[]" accept="video/*" multiple required>
                                        </div>

                                        <small id="selectedVideosInfo" class="text-muted mt-2 d-block selectedVideosInfo"></small>
                                    </div>

                                    <input type="hidden" name="stage_number" value="3">

                                    <button type="submit" class="btn btn-dark w-100">{{__('profile.Submit')}}</button>
                                </form>
                            </div>
                        </div>

                    @else

                        <!-- ✅ عرض الفيديوهات بعد الوصول للحد المطلوب -->
                        @foreach($videos as $video)
                            <div class="col-12 col-md-6">
                                <div class="card border-0 cartSt">
                                    <div class="ratio ratio-16x9">
                                        <iframe
                                            src="{{ convertToEmbed($video->youtube_url) }}"
                                            title="Video"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>




            <div class="tab-pane fade show" id="stage4" role="tabpanel" aria-labelledby="stage4-tab">
            <div class="row align-items-center g-4 mt-5">

                @php
                    $stage = 4;
                    $data = $uploadedCounts[$stage];
                    $videos = $contestant->videos->where('stage_number', $stage);
                @endphp

                {{-- عرض العداد أعلى --}}
                <div class="col-12 mb-3">
                    <div class="text-center mb-2" style="font-weight: 600;">
                        {{__('profile.Videos for Stage')}} {{ $stage }}
                    </div>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge bg-secondary px-3 py-2">{{__('profile.Required')}}: {{ $data['required'] }}</span>
                        <span class="badge bg-secondary px-3 py-2">{{__('profile.Uploaded')}}: {{ $data['uploaded'] }}</span>
                        <span class="badge bg-secondary px-3 py-2">{{__('profile.Remaining')}}: {{ $data['remaining'] }}</span>
                    </div>
                </div>

                {{-- ✅ إذا وصل عدد الفيديوهات المطلوب → اخفاء الفورم واظهار الفيديوهات --}}
                @if($data['remaining'] > 0)

                    <!-- ✅ الفورم يظهر فقط إذا المتسابق لسه ماوصلش الحد المطلوب -->
                    <div class="col-12 col-md-12">
                        <div class="card p-4 border-0">

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form id="uploadVideoForm"
                                action="{{ route('contestant.videos.upload') }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <!-- Developer Select -->
                                <div class="mb-3">
                                    <select class="form-select developerSelect" id="developerSelect" required>
                                        <option selected disabled value="">{{__('profile.Select Developer')}}</option>
                                        @foreach($developers as $developer)
                                            <option value="{{ $developer->id }}">{{ $developer->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Projects Select (Will be filled dynamically) -->
                                <div class="mb-3">
                                    <select class="form-select projectsSelect" name="project_id" id="projectsSelect" required disabled>
                                        <option selected disabled value="">{{__('profile.Select Project')}}</option>
                                    </select>
                                </div>

                                <!-- Upload Videos -->
                                <div class="mb-3">
                                    <div class="upload-box">
                                        <div class="upload-text" id="videoUploadLabel">
                                            <i class="fas fa-upload"></i> {{__('profileUpload Video.')}}
                                        </div>
                                        <input type="file" class="videoInput" id="videoInput" name="video_files[]" accept="video/*" multiple required>
                                    </div>

                                    <small id="selectedVideosInfo" class="text-muted mt-2 d-block selectedVideosInfo"></small>
                                </div>

                                <input type="hidden" name="stage_number" value="4">

                                <button type="submit" class="btn btn-dark w-100">{{__('profile.Submit')}}</button>
                            </form>
                        </div>
                    </div>

                @else

                    <!-- ✅ عرض الفيديوهات بعد الوصول للحد المطلوب -->
                    @foreach($videos as $video)
                            <div class="col-12 col-md-6">
                                <div class="card border-0 cartSt">
                                    <div class="ratio ratio-16x9">
                                        <iframe
                                            src="{{ convertToEmbed($video->youtube_url) }}"
                                            title="Video"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                @endif
            </div>
        </div>



        </div>
    </section>





    <style>
        .stage-tabs .nav-link {
            background: #f1f1f1;
            color: #000;
            border-radius: 8px;
            margin: 0 4px;
            font-size: 16px;
            font-weight: 400;
            text-align: center;
            padding: 10px 0;
            font-family: 'NowR', sans-serif;
        }

        .stage-tabs .nav-link.active {
            background: #000;
            color: #fff;
        }

        .stage-tabs {
            border-bottom: none !important;
        }

        .cartSt{
            border-radius: 10px;
            overflow: hidden;
        }


        .upload-box {
        border: 2px dashed #ccc;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #FAF9F9;
    }

        .upload-box:hover {
        border-color: #999;
        background-color: #f1f1f1;
        }

        .upload-box input[type="file"] {
        position: absolute;
        opacity: 0;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        }

        .upload-box i {
        font-size: 24px;
        color: #6c757d;
        margin-right: 8px;
        }

        .upload-text {
        font-weight: 500;
        color: #555;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        }


        @media (max-width: 768px) {
            .stage-tabs {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* كل صف يحتوي على زرين */
                gap: 10px; /* مسافة بين الأزرار */
            }

            .stage-tabs .nav-item {
                flex: unset;
                width: 100%;
            }

            .stage-tabs .nav-link {
                font-size: 13px;
                padding: 8px 10px;
            }
        }







    </style>

<!--     <script>
document.getElementById('developerSelect').addEventListener('change', function () {
    let developerId = this.value;

    fetch(`/developer/${developerId}/projects`)
        .then(response => response.json())
        .then(data => {
            let projectDropdown = document.getElementById('projectsSelect');
            projectDropdown.innerHTML = '<option selected disabled value="">Select Project</option>';

            if (data.success && data.projects.length > 0) {
                data.projects.forEach(project => {
                    projectDropdown.innerHTML += `<option value="${project.id}">${project.name_en}</option>`;
                });
                projectDropdown.disabled = false;
            } else {
                projectDropdown.disabled = true;
            }
        });
});
</script>
 -->


 <script>


document.querySelectorAll('form[id="uploadVideoForm"]').forEach(form => {
    form.addEventListener('submit', function () {
        document.getElementById('videoUploadLoader').style.display = 'flex';
    });
});
 document.querySelectorAll('.developerSelect').forEach(select => {
    select.addEventListener('change', function () {
        let developerId = this.value;
        let projectDropdown = this.closest('form').querySelector('.projectsSelect');

        fetch(`/developer/${developerId}/projects`)
            .then(response => response.json())
            .then(data => {
                projectDropdown.innerHTML = '<option selected disabled value="">Select Project</option>';

                if (data.success && data.projects.length > 0) {
                    data.projects.forEach(project => {
                        projectDropdown.innerHTML += `<option value="${project.id}">${project.name_en}</option>`;
                    });
                    projectDropdown.disabled = false;
                } else {
                    projectDropdown.disabled = true;
                }
            });
    });
});







/* document.getElementById('videoInput').addEventListener('change', function () {
    const files = this.files;
    const label = document.getElementById('videoUploadLabel');
    const info = document.getElementById('selectedVideosInfo');

    if (files.length > 0) {


        let list = "";
        for (let i = 0; i < files.length; i++) {
            list += `• ${files[i].name}<br>`;
        }
        info.innerHTML = list;
    } else {
        info.innerHTML = "";
    }
});
 */


document.querySelectorAll('.videoInput').forEach(input => {
    input.addEventListener('change', function () {

        const files = this.files;
        const info = this.closest('form').querySelector('.selectedVideosInfo');

        if (files.length > 0) {

            info.innerHTML = `Selected: ${files[0].name}`;
        } else {

            info.innerHTML = "";
        }
    });
});

</script>
