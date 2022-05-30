<template>
    <span>Rp. {{displayValue}}</span>
</template>

<script>
export default {
    name: "currency",
    props: ["value"],
    computed: {
        displayValue:function () {
            return helper.currency.displayCurrency(this.$props.value)
        }
    }
}
</script>

<style scoped>

</style>
