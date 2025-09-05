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
    <label for="valor" class="form-label">
        Quanto quer guardar
    </label>
    <input type="text" class="form-control" name="valor" id="valor" x-model="investimento.valor">
</div>
{{-- tipo --}}
<div class="mb-3">
    <label for="tipo_investimento" class="form-label">
        Qual tipo do investimento
    </label>
    <select name="tipo_investimento" id="tipo_investimento" class="form-control"
        x-model="investimento.tipo_investimento">
        <option value=""selected disabled>Selecione</option>
        <option value="cdb">CBD</option>
        <option value="fiis">FIIS</option>
    </select>
    <template x-if="errors.tipo_investimento">
        <span class="text-danger">Campo obrigatório</span>
    </template>
</div>
