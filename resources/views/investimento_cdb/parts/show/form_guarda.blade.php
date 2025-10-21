<x-modal.form title="Acrescenta investimento" button='Guardar'
    action="{{ route('investimentoCbd.guarda', $investimento->id) }}" submit="guarda({{ $investimento->id }})">
    <x-slot:form>
        <div class="mb-3">
            <label for="valor_aplicado" class="form-label required">Quanto quer guarda?</label>
            <input type="text" class="form-control" name="valor_aplicado" id="valor_aplicado"
                x-model='guardaValor.valor_aplicado'>
            <template x-if='errors.valor_aplicado'>
                <span class="text-danger">
                    Campo obrigatório
                </span>
            </template>
        </div>
        <div>
            <label for="data" class="form-label required">Data</label>
            <input type="date" class="form-control" name="data" id="data" x-model='guardaValor.data'>
            <template x-if='errors.data'>
                <span class="text-danger" x-text="errors.data">
                </span>
            </template>
        </div>
    </x-slot:form>
</x-modal.form>
