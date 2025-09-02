@extends('layouts.front')

@section('content')

    <div class="breadcrumb-bar">
        <div class="breadcrumb-container">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span> <i class="fas fa-chevron-left"></i> </span>
            <a href="{{ route('suggestions.index') }}" class="active">{{ __('front.suggest_initiative') }}</a>
        </div>
    </div>

    <section class="mutasem-propose-intro">
        <div class="mutasem-container">
            <h2 class="mutasem-title">{{ __('front.suggest_initiative') }}</h2>
            <p class="mutasem-subtitle">{{ __('front.appreciate_initiatives') }}</p>
        </div>
    </section>

    <section class="mutasem-propose-guidelines">
        <h2 class="mutasem-title">ارشادات التقديم</h2>
        <div class="mutasem-container mutasem-guideline-grid">

            <!-- Fill Form -->
            <div class="mutasem-guideline-box" style="text-align:center;">
                <div class="mutasem-guideline-icon"
                    style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                        stroke="#fff" stroke-width="2">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                    </svg>
                </div>
                <h4 style="margin:8px 0; font-size:16px; font-weight:600; color:#333;">
                    {{ __('front.fill_form') }}
                </h4>
                <p style="font-size:14px; color:#555; margin:0;">
                    {{ __('front.provide_detailed_info') }}
                </p>
            </div>


            <!-- Submit -->
            <div class="mutasem-guideline-box" style="text-align:center;">
                <div class="mutasem-guideline-icon"
                    style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                        stroke="#fff" stroke-width="2">
                        <path d="M22 2 11 13" />
                        <path d="m22 2-7 20-4-9-9-4 20-7z" />
                    </svg>
                </div>
                <h4 style="margin:8px 0; font-size:16px; font-weight:600; color:#333;">
                    {{ __('front.submit') }}
                </h4>
                <p style="font-size:14px; color:#555; margin:0;">
                    {{ __('front.review_by_team') }}
                </p>
            </div>

            <!-- Follow Up -->
            <div class="mutasem-guideline-box" style="text-align:center;">
                <div class="mutasem-guideline-icon"
                    style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                        stroke="#fff" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                </div>
                <h4 style="margin:8px 0; font-size:16px; font-weight:600; color:#333;">
                    {{ __('front.follow_up') }}
                </h4>
                <p style="font-size:14px; color:#555; margin:0;">
                    {{ __('front.track_submission_status') }}
                </p>
            </div>


        </div>
    </section>

    <section class="suggestion-form-section">
        <div class="container">
            <h3 class="form-title">{{ __('front.submit_suggestion_request') }}</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-progress" style="display:flex; align-items:center; justify-content:center; gap:30px;">

                <!-- Step 1 -->
                <div class="step" style="display:flex; flex-direction:column; align-items:center;">
                    <div id="step1-circle"
                        style="width:30px; height:30px; border-radius:50%; background:#076046; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                        1
                    </div>
                    <div class="label" style="margin-top:6px; font-size:14px; color:#076046;">
                        {{ __('front.personal_information') }}
                    </div>
                </div>

                <!-- الخط -->
                <div style="width:60px; height:2px; background:#ccc;"></div>

                <!-- Step 2 -->
                <div class="step" style="display:flex; flex-direction:column; align-items:center;">
                    <div id="step2-circle"
                        style="width:30px; height:30px; border-radius:50%; background:#fff; color:#555; border:2px solid #ccc; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                        2
                    </div>
                    <div class="label" style="margin-top:6px; font-size:14px; color:#555;">
                        {{ __('front.suggestion_information') }}
                    </div>
                </div>

            </div>


            <div class="form-box">
                <form id="suggestion-form" action="{{ route('suggestions.store') }}" method="POST">
                    @csrf

                    <!-- Step 1: Personal Information -->
                    <div class="form-step active" id="step1">
                        <h4 class="form-heading">{{ __('front.personal_information') }}</h4>
                        <p class="form-alert">
                            <span class="icon">ℹ️</span>
                            {{ __('front.data_privacy_notice') }}
                        </p>

                        <div class="form-group">
                            <label>{{ __('front.full_name') }}</label>
                            <input type="text" name="name" placeholder="{{ __('front.full_name') }}"
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>{{ __('front.contact_number') }}</label>
                            <input type="text" name="phone" placeholder="{{ __('front.contact_number') }}"
                                value="{{ old('phone') }}" required>
                        </div>

                        <div class="form-group">
                            <label>{{ __('front.choose_age') }}</label>
                            <select name="age" required>
                                <option value="" disabled {{ old('age') ? '' : 'selected' }}>
                                    {{ __('front.choose_age') }}</option>
                                <option value="18-25" {{ old('age') == '18-25' ? 'selected' : '' }}>18-25</option>
                                <option value="26-35" {{ old('age') == '26-35' ? 'selected' : '' }}>26-35</option>
                                <option value="36-45" {{ old('age') == '36-45' ? 'selected' : '' }}>36-45</option>
                                <option value="46-55" {{ old('age') == '46-55' ? 'selected' : '' }}>46-55</option>
                                <option value="56-65" {{ old('age') == '56-65' ? 'selected' : '' }}>56-65</option>
                                <option value="65+" {{ old('age') == '65+' ? 'selected' : '' }}>65+</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('front.gender') }}</label>
                            <select name="gender" required>
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>
                                    {{ __('front.choose_gender') }}</option>
                                <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>
                                    {{ __('front.male') }}</option>
                                <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>
                                    {{ __('front.female') }}</option>
                            </select>
                        </div>

                        <div class="form-group" style="margin-top:8px;">
                            <label style="display:flex; align-items:center; gap:8px;">
                                <input type="checkbox" name="hide_identity" value="1"
                                    style="width:16px; height:16px;">
                                {{ __('front.hide_my_identity') }}
                            </label>
                        </div>

                        <div style="text-align:center; margin-top:16px;">
                            <button type="button" id="nextBtn" class="next-btn"
                                style="display:none; background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;width: 15%"
                                onclick="goNext()">
                                {{ __('front.next') }} ←
                            </button>
                        </div>


                    </div>

                    <!-- Step 2: Suggestion Information -->
                    <div class="form-step" id="step2">
                        <h4 class="form-heading">{{ __('front.suggestion_information') }}</h4>


                        {{-- الموضوع --}}
                        <div class="form-group">
                            <label>{{ __('front.title_en') }}</label>
                            <input type="text" name="title_en" placeholder="{{ __('front.title_en') }}"
                                value="{{ old('title_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('front.title_ar') }}</label>
                            <input type="text" name="title_ar" placeholder="{{ __('front.title_ar') }}"
                                value="{{ old('title_ar') }}" required>
                        </div>

                        {{-- الوصف --}}
                        <div class="form-group">
                            <label>{{ __('front.description_en') }}</label>
                            <textarea name="description_en" rows="6" required>{{ old('description_en') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{ __('front.description_ar') }}</label>
                            <textarea name="description_ar" rows="6" required>{{ old('description_ar') }}</textarea>
                        </div>


                        <div class="form-buttons"
                            style="display:flex; gap:10px; justify-content:center; margin-top:16px;">
                            <button type="button" class="prev-btn"
                                style="background:#fff; color:#076046; border:2px solid #076046; padding:9px 16px; border-radius:8px; cursor:pointer; font-size:14px; display:inline-flex; align-items:center; gap:6px;"
                                onclick="goPrev()">
                                ← {{ __('front.previous') }}
                            </button>
                            <button type="submit" class="submit-btn"
                                style="background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;width: 20%">
                                {{ __('front.submit_suggestion') }}
                            </button>
                        </div>

                    </div>


                </form>
            </div>


        </div>
    </section>
    <script>
        (function() {
            const stepEl = {
                1: document.getElementById('step1'),
                2: document.getElementById('step2')
            };
            const circleEl = {
                1: document.getElementById('step1-circle'),
                2: document.getElementById('step2-circle')
            };
            const labelEl = {
                1: document.querySelector('.form-progress .step:nth-child(1) .label'),
                2: document.querySelector('.form-progress .step:nth-child(3) .label') // بعد عنصر الخط
            };

            function setProgress(activeStep) {
                if (activeStep === 1) {
                    // دائرة 1 خضراء
                    circleEl[1].style.background = '#076046';
                    circleEl[1].style.color = '#fff';
                    circleEl[1].style.border = 'none';
                    if (labelEl[1]) labelEl[1].style.color = '#076046';

                    // دائرة 2 بيضاء
                    circleEl[2].style.background = '#fff';
                    circleEl[2].style.color = '#555';
                    circleEl[2].style.border = '2px solid #ccc';
                    if (labelEl[2]) labelEl[2].style.color = '#555';
                } else {
                    // دائرة 1 "تم"
                    circleEl[1].style.background = '#fff';
                    circleEl[1].style.color = '#076046';
                    circleEl[1].style.border = '2px solid #076046';
                    if (labelEl[1]) labelEl[1].style.color = '#555';

                    // دائرة 2 خضراء
                    circleEl[2].style.background = '#076046';
                    circleEl[2].style.color = '#fff';
                    circleEl[2].style.border = 'none';
                    if (labelEl[2]) labelEl[2].style.color = '#076046';
                }
            }

            function show(stepNum) {
                stepEl[1].style.display = (stepNum === 1 ? 'block' : 'none');
                stepEl[2].style.display = (stepNum === 2 ? 'block' : 'none');
                setProgress(stepNum);
            }

            function isStep1Valid() {
                const name = document.querySelector('#step1 input[name="name"]');
                const phone = document.querySelector('#step1 input[name="phone"]');
                const age = document.querySelector('#step1 select[name="age"]');
                const gender = document.querySelector('#step1 select[name="gender"]');
                return !!(name?.value.trim() && phone?.value.trim() && age?.value && gender?.value);
            }

            function refreshNextBtn() {
                const btn = document.getElementById('nextBtn');
                if (!btn) return;
                btn.style.display = isStep1Valid() ? 'inline-block' : 'none';
            }

            // نجعل الدوال متاحة للزرار
            window.goNext = function() {
                if (!isStep1Valid()) {
                    alert('{{ __('front.please_fill_required_fields') }}');
                    return;
                }
                stepEl[1].classList.remove('active');
                stepEl[2].classList.add('active');
                show(2);
            };

            window.goPrev = function() {
                stepEl[2].classList.remove('active');
                stepEl[1].classList.add('active');
                show(1);
            };

            document.addEventListener('DOMContentLoaded', function() {
                // اعرض الخطوة الأولى فقط
                show(1);

                // اربط الأحداث على الخانات المطلوبة لإظهار/إخفاء زر "التالي"
                document.querySelectorAll('#step1 input[required], #step1 select[required]').forEach(el => {
                    ['input', 'change', 'keyup', 'blur'].forEach(evt => el.addEventListener(evt,
                        refreshNextBtn));
                });

                // دعم الأوتوفيل
                refreshNextBtn();
                setTimeout(refreshNextBtn, 0);

            });
        })();
    </script>


@endsection
