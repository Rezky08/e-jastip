<template>
    <button
        class="btn"
        :class="[{
        'btn-rounded' : rounded,
        'btn-circle' : circle,
        },
        size?`btn-${size}`:undefined,
        color?$consts.color.getColorClass('btn-',color,outline):undefined
        ]"
    >
        <slot/>
    </button>

</template>

<script>
export default {
    name: "Button",
    props: {
        rounded: Boolean,
        circle: Boolean,
        outline: Boolean,
        color: {
            type: String,
            default: "primary",
            validator(value) {
                // The value must match one of these strings
                return [consts.color.COLORS].includes(value)
            }
        },
        size: {
            type: String,
            default: "primary",
            validator(value) {
                // The value must match one of these strings
                return [consts.size.SIZES].includes(value)
            }
        },
    }

}
</script>

<style scoped>

</style>
