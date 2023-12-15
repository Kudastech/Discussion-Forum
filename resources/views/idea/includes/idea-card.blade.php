<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px; height:50px; border-radius:50%; object-fit:cover;" class="me-2 avatar-sm rounded-circle" src="{{ $ideas->user->getImageURL() }}"
                    alt="{{ $ideas->user->name }}">
                <div>
                    <h5 class="mb-0 card-title"><a href="{{ route('users.show', $ideas->user->id) }}">
                            {{ $ideas->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ route('ideas.show', $ideas->id) }}"> View </a>
                @auth()
                    @can('idea-edit', $ideas)
                        <a class="mx-2" href="{{ route('ideas.edit', $ideas->id) }}"> Edit </a>
                        <form method="POST" action="{{ route('ideas.destroy', $ideas->id) }}">
                            @csrf
                            @method('delete')
                            <button class="ms-1 btn btn-danger btn-sm"> X </button>
                        </form>
                    @endcan
                @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $ideas->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $ideas->content }}</textarea>
                    @error('content')
                        <span class="mt-2 d-block fs-6 text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="mb-2 btn btn-dark btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $ideas->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('idea.includes.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $ideas->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('idea.includes.comment-box')
    </div>
</div>
