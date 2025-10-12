{{-- nome --}}
<div class="mb-3">
    <label for="nome" class="form-label required">
        Nome
    </label>
    <input type="text" id="nome" class="form-control" name="nome" x-model="investimento.nome">

    <template x-if="errors.nome">
        <span class="text-danger">Campo obrigatório</span>
    </template>
</div>
{{-- banco --}}
<div class="mb-3">
    <label for="conta_bancaria" class="form-label required">
        Banco
    </label>
    <select name="conta_bancaria" id="conta_bancaria" class="form-control" x-model="investimento.conta_bancaria">
        <option value="" selected disabled>Selecione</option>
        @foreach ($contaBancaria as $contaBancaria)
            <option value="{{ $contaBancaria->id }}">
                {{ $contaBancaria->nome }}
            </option>
        @endforeach
    </select>

    <template x-if="errors.conta_bancaria">
        <span class="text-danger">Campo obrigatório</span>
    </template>
</div>

{{-- valor --}}
<div class="mb-3">
    <label for="valor_bruto" class="form-label">
        Quanto quer guardar
    </label>
    <input type="text" class="form-control" name="valor_aplicado" id="valor_aplicado"
        x-model="investimento.valor_aplicado">
</div>


<div class="row mb-3">
    {{-- tipo --}}
    <div class="col-6">
        <label for="tipo_investimento" class="form-label required">
            Qual tipo do investimento
        </label>
        <select name="tipo_investimento" id="tipo_investimento" class="form-control"
            x-model="investimento.tipo_investimento" required>
            <option value=""selected disabled>Selecione</option>
            <option value="cdb">CBD</option>
            <option value="fiis">FIIS</option>
        </select>
        <template x-if="errors.tipo_investimento">
            <span class="text-danger">Campo obrigatório</span>
        </template>
    </div>
    {{-- data --}}
    <div class="col-6">
        <label for="data" class="form-label">
            Data de inicio
        </label>
        <div class="input-icon">
            <span class="input-icon-addon">
                <x-icons.icon-calendar-number />
            </span>
            <input type="date" class="form-control" name="data" id="data"
                value="{{ old('data', now()->format('Y-m-d')) }}" x-model="investimento.data">
        </div>
    </div>
</div>
