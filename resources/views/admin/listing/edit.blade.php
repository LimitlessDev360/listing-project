@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            {{-- <div class="section-header-back">
            <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div> --}}
            <h4>Listing</h4>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.listing.index') }}">Lising</a></div>
                <div class="breadcrumb-item">Edit</a></div>
            </div>
        </div>

        <div class="section-body">
            {{-- profile --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Listing</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.listing.update', $listing->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Images --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Image <span class="text-danger">*</span></label>
                                            <div id="image-preview" class="image-preview preview-1">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="image" id="image-upload" />
                                                <input type="hidden" name="old_image" value="{{ $listing->image }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Thumbnail Image <span class="text-danger">*</span></label>
                                            <div id="image-preview-2" class="image-preview preview-2">
                                                <label for="image-upload-2" id="image-label-2">Choose File</label>
                                                <input type="file" name="thumbnail_image" id="image-upload-2" />
                                                <input type="hidden" name="old_thumbnail_image"
                                                    value="{{ $listing->thumbnail_image }}" />

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required
                                        value="{{ $listing->title }}">
                                </div>

                                {{-- Category and Location --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Category <span class="text-danger">*</span></label>
                                            <select name="category" id="" class="form-control" required>
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option @selected($category->id === $listing->category_id) value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Location <span class="text-danger">*</span></label>
                                            <select name="location" id="" class="form-control" required>
                                                <option value="">Select</option>
                                                @foreach ($locations as $location)
                                                    <option @selected($location->id === $listing->location_id) value="{{ $location->id }}">
                                                        {{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div class="form-group">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" required
                                        value="{{ $listing->address }}">
                                </div>

                                {{-- Phone and Links --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" required
                                                value="{{ $listing->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" required
                                                value="{{ $listing->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Website</label>
                                            <input type="text" class="form-control" name="website"
                                                value="{{ $listing->website }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" class="form-control" name="facebook_link"
                                                value="{{ $listing->facebook_link }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">X Link</label>
                                            <input type="text" class="form-control" name="x_link"
                                                value="{{ $listing->x_link }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Linkedin</label>
                                            <input type="text" class="form-control" name="linkedin_link"
                                                value="{{ $listing->linkedin_link }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Whatsapp</label>
                                            <input type="text" class="form-control" name="whatsapp_link"
                                                value="{{ $listing->whatsapp_link }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if ($listing->file)
                                            <div>
                                                <i class="fas fa-file-alt" style="font-size: 70px"></i>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="">Attachment <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="attachment">
                                            <input type="hidden" class="form-control" name="old_attachment"
                                                value="{{ $listing->file }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Amenities <span class="text-danger">*</span></label>
                                    <select class="form-control select2" multiple=""name="amenities[]">
                                        @foreach ($amenities as $amenity)
                                            <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="summernote">{!! $listing->description !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Google Map Embed Code</label>
                                    <textarea name="google_map_embed_code" class="form-control">{!! $listing->goolge_map_embed_code !!}</textarea>
                                </div>

                                {{-- SEO --}}
                                <div class="form-group">
                                    <label for="">Seo Title</label>
                                    <input type="text" name="seo_title" class="form-control"
                                        value="{{ $listing->seo_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Seo Description</label>
                                    <textarea name="seo_description" class="form-control">{!! $listing->seo_description !!}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="" class="form-control" required>
                                                <option @selected($listing->status === 1) value="1">Active</option>
                                                <option @selected($listing->status === 0) value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Is Featured <span class="text-danger">*</span></label>
                                            <select name="is_featured" id="" class="form-control" required>
                                                <option @selected($listing->is_featured === 0) value="0">No</option>
                                                <option @selected($listing->is_featured === 1) value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Is Verified <span class="text-danger">*</span></label>
                                            <select name="is_verified" id="" class="form-control" required>
                                                <option @selected($listing->is_verified === 0) value="0">No</option>
                                                <option @selected($listing->is_verified === 1) value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.preview-1').css({
                'background-image': 'url({{ asset($listing->image) }})',
                'background-size': 'cover',
                'background-position': 'center center',
            });
            $('.preview-2').css({
                'background-image': 'url({{ asset($listing->thumbnail_image) }})',
                'background-size': 'cover',
                'background-position': 'center center',
            });
        })

        $.uploadPreview({
            input_field: "#image-upload-2", // Default: .image-upload
            preview_box: "#image-preview-2", // Default: .image-preview
            label_field: "#image-label-2", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        // pre selected amenities
        var listingAmenities = {!! json_encode($listingAmenities) !!}
        $('.select2').select2().val(listingAmenities).trigger("change")
    </script>
@endpush