@extends('lay.html')

@section('title','debug')

@section('style')
	.block {
		color:#353535;
		padding: 10px;
		font-size:15px;
		border-bottom:1px dotted #212121;
	}
	.array, .object {
		padding: 2px 0 2px 10px;
		font-size: 14px;
	}
	.array > div, .object > div {
		padding: 0 0 0 10px;
	}
	.oneLine {
		white-space: nowrap;
	}
	.showArr {
		display: none;
	}
	.oneLine > .value {
		display: inline-block;
		padding: 0 0 0 3px;
	} 
	.showArr:checked ~ .value {
		display: block;
	}
	.type {
		color: #CCC;
		font-size: 14px;
		padding: 0 4px 0 0;
	}
	.key {
		font-weight: bold;
		color: #ffc107;
		cursor: pointer;
	}
	.numeric {
		color: #084298;
	}
	.string {
		color: #6c757d;
	}
	.string:before, .string:after {
		content: '"';
	}
	.toggle {
		cursor: pointer;
	}
	.child_block {
		display: none;
		padding: 0;
		transition: 0.5s;
	}
	.show {
		display: inline;
	}
@endsection

@section('content')
	<div class='block'>
		{!!$data!!}
	</div>
	
@endsection
<script>
	document.addEventListener("DOMContentLoaded", function() {
		listenToggle();
	});
	function listenToggle() {
		for (let obj of document.getElementsByClassName('toggle')) {
			obj.addEventListener('click', toggleInput);
		}
	}
	function toggleInput(evt) {
		this.nextSibling.classList.toggle('show');
	}
</script>