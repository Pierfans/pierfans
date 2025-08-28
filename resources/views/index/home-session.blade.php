=@extends('layouts.app')

@php
    use App\Models\Highlight;
    $highlights = Highlight::getActiveHighlights();

@endphp

@section('content')
  <section class="container">
    <div class="my-6 grid grid-cols-1 md:grid-cols-[260px_1fr_300px] items-start gap-6">
      @include('includes.menu-sidebar-home')

      <div class="second wrap-post w-full p-0">
        <div
          class="mb-6 flex h-auto flex-col items-start gap-3 !rounded-lg border !border-red-300 bg-red-100 p-3 shadow-sm">
          <p class="m-0 flex gap-1 text-left font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" fill="none" viewBox="0 0 24 24">
              <path stroke="url(#a)" stroke-linecap="round" stroke-linejoin="round"
                d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978m7-7.318v1.626a2 2 0 0 0 .976 1.696A4.999 4.999 0 0 1 17 21.978M18 9h1.5a2.5 2.5 0 0 0 0-5H18m0 5A6 6 0 1 1 6 9m12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v6M4 22h16M6 9H4.5a2.5 2.5 0 1 1 0-5H6" />
              <defs>
                <linearGradient id="a" x1="2" x2="22" y1="12" y2="12"
                  gradientUnits="userSpaceOnUse">
                  <stop stop-color="#EC4899" />
                  <stop offset="1" stop-color="#F97316" />
                </linearGradient>
              </defs>
            </svg>
            Top 5 Criadores
          </p>

          <div class="grid w-full grid-cols-3 sm:grid-cols-5 justify-between gap-2 sm:gap-3">
            @foreach ($highlights as $highlight)
              <a href="{{ url($highlight['username']) }}" class="flex flex-1 flex-col items-center gap-2">
                <div class="relative rounded-full border !border-red-600">
                  <img src="{{ Helper::getFile(config('path.avatar') . $highlight['avatar']) }}"
                    class="aspect-square w-full rounded-full border-2 border-white object-cover">
                </div>
                <span class="w-full truncate text-sm" style="font-weight: 500">{{ '@' . $highlight['username'] }}</span>
              </a>
            @endforeach
          </div>
        </div>

        @if ($stories->count() || ($settings->story_status && auth()->user()->verified_id == 'yes'))
          <div id="stories" class="storiesWrapper mb-2 p-2">
            @if ($settings->story_status && auth()->user()->verified_id == 'yes')
              <div class="add-story" title="{{ __('general.add_story') }}">
                <a class="item-add-story" href="#" data-toggle="modal" data-target="#addStory">
                  <span class="add-story-preview">
                    <img lazy="eager" width="100"
                      src="{{ Helper::getFile(config('path.avatar') . auth()->user()->avatar) }}">
                  </span>
                  <span class="info bg-primary py-3 text-center text-white">
                    <strong class="name" style="text-shadow: none;"><i class="bi-plus-circle-dotted mr-1"></i>
                      {{ __('general.add_story') }}</strong>
                  </span>
                </a>
              </div>
            @endif
          </div>
        @endif

        @if (
            ($settings->announcement != '' &&
                $settings->announcement_show == 'creators' &&
                auth()->user()->verified_id == 'yes') ||
                ($settings->announcement != '' && $settings->announcement_show == 'all'))
          <div class="alert alert-{{ $settings->type_announcement }} announcements display-none card-border-0"
            role="alert">
            <button type="button" class="close" id="closeAnnouncements">
              <span aria-hidden="true">
                <i class="bi bi-x-lg"></i>
              </span>
            </button>

            <h4 class="alert-heading"><i class="bi bi-megaphone mr-2"></i> {{ __('general.announcements') }}</h4>
            <p class="update-text">
              {!! $settings->announcement !!}
            </p>
          </div><!-- end announcements -->
        @endif

        @if ($payPerViewsUser != 0)
          <div class="col-md-12 d-none">
            <ul class="list-inline">
              <li class="list-inline-item text-uppercase h5">
                <a href="{{ url('/') }}"
                  class="text-decoration-none @if (request()->is('/')) link-border @else text-muted @endif">{{ __('admin.home') }}</a>
              </li>
              <li class="list-inline-item text-uppercase h5">
                <a href="{{ url('my/purchases') }}"
                  class="text-decoration-none @if (request()->is('my/purchases')) link-border @else text-muted @endif">{{ __('general.purchased') }}</a>
              </li>
            </ul>
          </div>
        @endif

        @if (auth()->user()->verified_id == 'yes')
          @include('includes.modal-add-story')

          @include('includes.form-post')
        @endif

        @if ($updates->count() != 0)
          <div class="grid-updates position-relative" id="updatesPaginator">
            @include('includes.updates')
          </div>
        @else
          <div class="grid-updates position-relative" id="updatesPaginator"></div>

          <div class="no-updates my-5 text-center">
            <span class="btn-block mb-3">
              <i class="fa fa-photo-video ico-no-result"></i>
            </span>
            <h4 class="font-weight-light">{{ __('general.no_posts_posted') }}</h4>

            <a href="{{ url('creators') }}" class="btn btn-primary d-lg-none mb-3 mt-2 px-5">
              {{ __('general.explore_creators') }}
            </a>

            <a href="{{ url('explore') }}" class="btn btn-primary d-lg-none px-5">
              {{ __('general.explore_posts') }}
            </a>
          </div>
        @endif
      </div><!-- end col-md-12 -->

      @include('includes.explore_creators')
  </section>
  @include('index.home-footer')
@endsection

@section('javascript')
  @if (session('noty_error'))
    <script type="text/javascript">
      swal({
        title: "{{ __('general.error_oops') }}",
        text: "{{ __('general.already_sent_report') }}",
        type: "error",
        confirmButtonText: "{{ __('users.ok') }}"
      });
    </script>
  @endif

  @if (session('noty_success'))
    <script type="text/javascript">
      swal({
        title: "{{ __('general.thanks') }}",
        text: "{{ __('general.reported_success') }}",
        type: "success",
        confirmButtonText: "{{ __('users.ok') }}"
      });
    </script>
  @endif

  @if (session('success_verify'))
    <script type="text/javascript">
      swal({
        title: "{{ __('general.welcome') }}",
        text: "{{ __('users.account_validated') }}",
        type: "success",
        confirmButtonText: "{{ __('users.ok') }}"
      });
    </script>
  @endif

  @if (session('error_verify'))
    <script type="text/javascript">
      swal({
        title: "{{ __('general.error_oops') }}",
        text: "{{ __('users.code_not_valid') }}",
        type: "error",
        confirmButtonText: "{{ __('users.ok') }}"
      });
    </script>
  @endif

  @if ($settings->story_status && $stories->count())
    <script>
      let stories = new Zuck('stories', {
        skin: 'snapssenger', // container class
        avatars: false, // shows user photo instead of last story item preview
        list: false, // displays a timeline instead of carousel
        openEffect: true, // enables effect when opening story
        cubeEffect: false, // enables the 3d cube effect when sliding story
        autoFullScreen: false, // enables fullscreen on mobile browsers
        backButton: true, // adds a back button to close the story viewer
        backNative: false, // uses window history to enable back button on browsers/android
        previousTap: true, // use 1/3 of the screen to navigate to previous item when tap the story
        localStorage: true, // set true to save "seen" position. Element must have a id to save properly.

        stories: [

          @foreach ($stories as $story)
            {
              id: "{{ $story->user->username }}", // story id
              photo: "{{ Helper::getFile(config('path.avatar') . $story->user->avatar) }}", // story photo (or user photo)
              name: "{{ $story->user->hide_name == 'yes' ? $story->user->username : $story->user->name }}", // story name (or user name)
              link: "{{ url($story->user->username) }}", // story link (useless on story generated by script)
              lastUpdated: {{ $story->created_at->timestamp }}, // last updated date in unix time format

              items: [
                // story item example

                @foreach ($story->media as $media)
                  {
                    id: "{{ $story->user->username }}-{{ $story->id }}", // item id
                    type: "{{ $media->type }}", // photo or video
                    length: {{ $media->type == 'photo' ? 5 : ($media->video_length ?: $settings->story_max_videos_length) }}, // photo timeout or video length in seconds - uses 3 seconds timeout for images if not set
                    src: "{{ Helper::getFile(config('path.stories') . $media->name) }}", // photo or video src
                    preview: "{{ $media->type == 'photo' ? route('resize', ['path' => 'stories', 'file' => $media->name, 'size' => 280]) : ($media->video_poster ? route('resize', ['path' => 'stories', 'file' => $media->video_poster, 'size' => 280]) : route('resize', ['path' => 'avatar', 'file' => $story->user->avatar, 'size' => 200])) }}", // optional - item thumbnail to show in the story carousel instead of the story defined image
                    link: "", // a link to click on story
                    linkText: '{{ $story->title }}', // link text
                    time: {{ $media->created_at->timestamp }}, // optional a date to display with the story item. unix timestamp are converted to "time ago" format
                    seen: false, // set true if current user was read
                    story: "{{ $media->id }}",
                    text: "{{ $media->text }}",
                    color: "{{ $media->font_color }}",
                    font: "{{ $media->font }}",
                  },
                @endforeach
              ]
            },
          @endforeach

        ],

        callbacks: {
          onView(storyId) {
            getItemStoryId(storyId);
          },

          onEnd(storyId, callback) {
            getItemStoryId(storyId);
            callback(); // on end story
          },

          onClose(storyId, callback) {
            getItemStoryId(storyId);
            callback(); // on close story viewer
          },

          onNavigateItem(storyId, nextStoryId, callback) {
            getItemStoryId(storyId);
            callback(); // on navigate item of story
          },
        },

        language: { // if you need to translate :)
          unmute: '{{ __('general.touch_unmute') }}',
          keyboardTip: 'Press space to see next',
          visitLink: 'Visit link',
          time: {
            ago: '{{ __('general.ago') }}',
            hour: '{{ __('general.hour') }}',
            hours: '{{ __('general.hours') }}',
            minute: '{{ __('general.minute') }}',
            minutes: '{{ __('general.minutes') }}',
            fromnow: '{{ __('general.fromnow') }}',
            seconds: '{{ __('general.seconds') }}',
            yesterday: '{{ __('general.yesterday') }}',
            tomorrow: 'tomorrow',
            days: 'days'
          }
        }
      });

      function getItemStoryId(storyId) {
        let userActive = '{{ auth()->user()->username }}';
        if (userActive !== storyId) {
          let itemId = $('#zuck-modal .story-viewer[data-story-id="' + storyId + '"]').find('.itemStory.active').data(
            'id-story');
          insertViewStory(itemId);
        }
        insertTextStory();
      }

      insertTextStory();

      function insertTextStory() {
        $('.previewText').each(function() {
          let text = $(this).find('.items>li:first-child>a').data('text');
          let font = $(this).find('.items>li:first-child>a').data('font');
          let color = $(this).find('.items>li:first-child>a').data('color');
          $(this).find('.text-story-preview').css({
            fontFamily: font,
            color: color
          }).html(text);
        });
      }

      function insertViewStory(itemId) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post(URL_BASE + "/story/views/" + itemId + "");
      }

      $(document).on('click', '.profilePhoto, .info>.name', function() {
        let element = $(this);
        let username = element.parents('.story-viewer').data('story-id');
        if (username) {
          window.location.href = URL_BASE + '/' + username;
        }
      });
    </script>
  @endif
@endsection
