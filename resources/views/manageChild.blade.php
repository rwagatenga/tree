<ul>

@foreach($childs as $child)

	<li>

	    {{ $child->title }}
	    {{ $child->parent_id }}

	@if(count($child->childs))

            @include('manageChild',['childs' => $child->childs])

        @endif

	</li>
@endforeach
</ul>