@php
    use App\Helpers\FormataMoeda;
@endphp
<div class="row">
    @foreach ($investimento as $investimento)
        <div class="col-6 col-md-2 mb-3">
            <a href="{{ route('investimento.show', $investimento->id) }}" class="text-decoration-none cursor-pointer">
                <div class="card p-0">
                    <div class="card-header p-1 justify-content-center">
                        <strong>
                            {{ $investimento->contaBancaria->nome }}
                        </strong>
                    </div>
                    <div class="p-1"
                        style="
                                height: 150px; 
                                background-image: url('{{ $investimento->contaBancaria->banco->image }}');
                                background-size: cover;
                                background-position: center">
                    </div>
                    <div class="card-footer p-1 text-center">
                        {{ $investimento->nome }}
                        <br>
                        <div>
                            <strong>R$:</strong> {{ FormataMoeda::formataMoeda($investimento->valor) }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
