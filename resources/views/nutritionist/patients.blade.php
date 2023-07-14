@extends('layouts.nutritionist')

@section('content')
<patients token="{{ auth()->user()->api_token }}" id="{{ auth()->user()->id }}"></patients>
@endsection

@section('scripts')
<script type="text/javascript">
    
</script>
@endsection