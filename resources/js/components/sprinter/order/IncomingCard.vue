<template>
    <card>
        <div class="row align-items-center">
            <div class="col-8">
                <div class="d-flex flex-column">
                    <span class="font-weight-bold">#{{ token }}</span>
                    <span>{{ universityName }}</span>
                    <span class="font-weight-bold">
                       <currency :value="amount"/>
                </span>
                </div>
            </div>
            <div class="col-4 text-right">
                <button-component :size="$consts.size.SIZE_SMALL" :color="$consts.color.COLOR_INFO" outline>Ambil
                </button-component>
            </div>
        </div>
    </card>
</template>

<script>
import Card from "../../Card";
import ButtonComponent from "../../ButtonComponent";
import Currency from "../../displays/currency";

export default {
    name: "IncomingCard",
    props: ["token", "universityName", "amount"],
    components: {Currency, Card, ButtonComponent},
}
</script>

<style scoped>

</style>
