@extends('template')
@section('menu')
    <div class="card">
        <div class="card-body">
            <form class="row d-flex" id="search_form" method="GET">
                <input type="hidden" name="sortir" id="sortir" value="{{ request('sortir') }}">
            </form>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu Name</th>
                            <th>Price</th>
                            <th>Inserted At</th>
                            <th>Inserted By</th>
                            <th>Updated At</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $no = $limit * $page - $limit;
                        ?>

                        @if ($menu->isEmpty())
                            <tr>
                                <td colspan="8" style="text-align: center">No data</td>
                            </tr>
                        @else
                            @foreach ($menu as $item)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $item->menu_name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        {{ date('d F Y H:i', strtotime($item->inserted_at)) }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ date('d F Y H:i', strtotime($item->updated_at)) }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-md-1 align-middle d-flex flex-column align-items-md-start">
                    <div class="btn-group">
                        <button type="button" class="btn btn-maroon dropdown-toggle"
                            style="background-color: maroon; color:white;" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ request('sortir') == null ? '10' : request('sortir') }}
                        </button>
                        <ul class="dropdown-menu" id="listSortir">
                            <li class="listAttr" value="10"><a class="dropdown-item">10</a></li>
                            <li class="listAttr" value="20"><a class="dropdown-item" href="#">20</a>
                            </li>
                            <li class="listAttr" value="50"><a class="dropdown-item" href="#">50</a>
                            </li>
                            <li class="listAttr" value="100"><a class="dropdown-item" href="#">100</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 align-middle d-flex flex-column align-items-md-start mt-2" id="showing_page">
                    Showing
                    {!! $menu->firstItem() !!} to
                    {!! $menu->lastItem() !!} of {!! $menu->total() !!} entries
                </div>
                <div class="col-md-6 d-flex flex-column align-items-md-end" id="showing_page">
                    {!! $menu->appends(request()->all())->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var strQuery, strUrlParams, nSortir, nSearch, nPaginatorSelected, nValue;

        $(".listAttr").click(function() {
            var nValue = $(this).val();
            $('#sortir').val(nValue);
            $('#search_form').submit();
        });

        $(".listAttr").click(function() {
            var nValue = $(this).val();
            $('#sortir').val(nValue);
            submitFilter(nValue);
        });

        $('.resetBtn').click(function() {
            $('#search_form').submit();
        });
    </script>
@endsection
