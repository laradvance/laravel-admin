<div class="box box-{{ $style }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools">
            {!! $tools !!}
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="table-responsive">
    <table class="table table-striped">
            <tbody>

                @foreach($fields as $field)
                    {!! $field->render() !!}
                @endforeach
            </tbody>
        <!-- /.box-body -->
    </table>
    </div>
</div>