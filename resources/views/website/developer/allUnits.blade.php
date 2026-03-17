

@foreach ($project->units as $unit)
        @php
           // عرض اسم النوع حسب اللغة الحالية
            $unitTypeName = app()->getLocale() === 'ar'
                ? ($unit->unitType->type_ar ?? 'غير محدد')
                : ($unit->unitType->type_en ?? 'Unknown');

            // نستخدم النوع كـ class للفلترة (بالإنجليزية لتفادي مشاكل الحروف)
            $unitTypeSlug = Str::slug($unit->unitType->type_en ?? 'unknown', '_');
        @endphp
        
        
        <div class="col-md-4 unit-card {{ $unitTypeSlug }}">
            <a href="{{ route('unit.details', $unit->id) }}" class="text-decoration-none text-dark">

            <div class="property-card ">
                <div class="image-wrapper">
                    <span class="unit-badge">{{ $unitTypeName }}</span>
                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $unit->main_photo }}" alt="Villa" class="card-img">
                    <div class="overlay"></div>
                </div>
                <div class="card-body p-3">
                    <h5 class="mb-3 fw-semibold" style="font-size:24px; color:#000;">
                        {{ $unit->name ?? 'Unnamed Unit' }}
                    </h5>
                    <div class="d-flex align-items-center text-muted small" style="font-size:13px; color:#6c757d;">

                        <!-- Bedrooms -->
                        <div class="d-flex align-items-center gap-1 me-3">
                            <img src="{{ asset('public/images/developer/units/icons/Stroke2.png') }}" alt="bed" width="16" class="me-1">
                            <span>{{ $unit->bedrooms ?? '-' }} bd</span>
                            <img  src="{{ asset('public/images/developer/units/icons/Frame.png') }}" alt="bath"  class="ms-3">
                        </div>

                        <!-- Bathrooms -->
                        <div class="d-flex align-items-center me-3">
                            <img src="{{ asset('public/images/developer/units/icons/Stroke.svg') }}" alt="bath" width="16" class="me-1">
                            <span>{{ $unit->bathrooms ?? '-' }} ba</span>
                            <img  src="{{ asset('public/images/developer/units/icons/Frame.png') }}" alt="bath"  class="ms-3">
                        </div>

                        <!-- Size -->
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('public/images/developer/units/icons/Stroke3.png') }}" alt="area" width="16" class="me-1">
                            <span>{{ $unit->area ?? '-' }} ft</span>
                        </div>

                    </div>
                </div>

            </div>
            </a>
        </div>
@endforeach




