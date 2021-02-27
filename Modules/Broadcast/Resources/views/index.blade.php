@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Broadcast Pengumuman</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('broadcast.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Tanggal')}}
                        </th>
                        <th>
                            {{ _('Pengirim')}}
                        </th>
                        <th>
                            {{ _('Judul')}}
                        </th>
                        <th>
                            {{ _('Terjadwal')}}
                        </th>
                        <th>
                            {{ _('Status')}}
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($broadcasts['data'] as $broadcast)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($broadcast['created_at'])->isoFormat('DD MMM YYYY') }}</td>
                            <td>{{ $broadcast['user']['name'] }}</td>
                            <td>{{ $broadcast['title'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($broadcast['schedule'])->isoFormat('DD MMM YYYY HH:ss') }}</td>
                            <td>{!! $broadcast['status'] == 'Terkirim' ? '<span class="badge badge-success">'. $broadcast['status'] .'</span>' : '<span class="badge badge-warning">'. $broadcast['status'] .'</span>'  !!}</td>
                            <td>
                                <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('broadcast.show', $broadcast['slug']) }}">Detail</a>
                                </div>
                                {{-- <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('broadcast.edit', $broadcast['slug']) }}">Edit</a>
                                </div> --}}
                                <div style="display: inline-block">
                                    <form action="{{ route('broadcast.destroy', $broadcast['slug']) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty

                    @endforelse
            
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>


        // function delay(delayInms) {
        //     return new Promise(resolve => {
        //         setTimeout(() => {
        //         resolve(2);
        //         }, delayInms);
        //     });
        // }

        // async function sample() {
        //     var array = [1,2,3,4,5,6,7,8,9,10];
        //     for (let index = 0; index < array.length; index++) {
        //         const element = array[index];
        //         $(document).Toasts('create', {
        //             title: 'Toast Title',
        //             body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        //             autohide:true,
        //             delay: 6000
        //         })
        //         let delayres = await delay(1000);
        //     }  
        // }

        // sample();
    </script>
@endsection