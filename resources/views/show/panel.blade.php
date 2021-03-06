<div class="box box-{{ $style }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools">
            {!! $tools !!}
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped">
                @foreach($fields as $field)
                    {!! $field->render() !!}
                @endforeach
			</table>
		</div>
    </div>
	<!-- /.box-body -->
</div>
