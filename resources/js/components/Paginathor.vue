<template>
    <div>
        <ul :class="containerClassProp">
            <li @click="handler(currentPage-1)" :class="prevButtonClassProp" v-if="prevPageUrl">
                <a href="javascript:void(0)" :class="numberClassProp">
                    <i :class="prevButtonIconProp" v-if="buttonIconsProp"></i>
                    {{prevButtonTextProp}}
                </a>
            </li>
            <li v-for="(number,i) in (numbers)" :key="i" @click="handler(number==='...' ? i+1 : number)"
                :class="{[numberButtonClassProp]:true,[activeClassProp]:isCurrent(number)}">
                <a href="javascript:void(0)" :class="numberClassProp">{{number}}</a>
            </li>
            <li @click="handler(currentPage+1)" :class="nextButtonClassProp" v-if="nextPageUrl">
                <i :class="nextButtonIconProp" v-if="buttonIconsProp"></i>
                <a href="javascript:void(0)" :class="numberClassProp">{{nextButtonTextProp}}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            data: {
                required: true
            },
            containerClass: {
                default: 'pagination'
            },
            buttonIcons: {
                default: false
            },
            prevButtonClass: {
                default: 'page-item'
            },
            prevButtonText: {
                default: 'Prev'
            },
            prevButtonIcon: {
                default: 'fa fa-chevron-left'
            },
            nextButtonClass: {
                default: 'page-item'
            },
            nextButtonText: {
                default: 'Next'
            },
            nextButtonIcon: {
                default: 'fa fa-chevron-right'
            },
            numberButtonClass: {
                default: 'page-item'
            },
            numberClass: {
                default: 'page-link'
            },
            activeClass: {
                default: 'active'
            },
            numbersCountForShow: {
                default: 2
            },
            changePage: {
                required: true
            },
            options: {},
            requestParams: {}
        },
        computed: {
            containerClassProp: function () {
                if (this.options && this.options.containerClass) {
                    return this.options.containerClass;
                }
                return this.containerClass;
            },
            buttonIconsProp: function () {
                if (this.options && this.options.buttonIcons) {
                    return this.options.buttonIcons;
                }
                return this.buttonIcons;
            },
            prevButtonClassProp: function () {
                if (this.options && this.options.prevButtonClass) {
                    return this.options.prevButtonClass;
                }
                return this.prevButtonClass;
            },
            prevButtonTextProp: function () {
                if (this.options && this.options.prevButtonText) {
                    return this.options.prevButtonText;
                }
                return this.prevButtonText;
            },
            prevButtonIconProp: function () {
                if (this.options && this.options.prevButtonIcon) {
                    return this.options.prevButtonIcon;
                }
                return this.prevButtonIcon;
            },
            nextButtonClassProp: function () {
                if (this.options && this.options.nextButtonClass) {
                    return this.options.nextButtonClass;
                }
                return this.nextButtonClass;
            },
            nextButtonTextProp: function () {
                if (this.options && this.options.nextButtonText) {
                    return this.options.nextButtonText;
                }
                return this.nextButtonText;
            },
            nextButtonIconProp: function () {
                if (this.options && this.options.nextButtonIcon) {
                    return this.options.nextButtonIcon;
                }
                return this.nextButtonIcon;
            },
            numberButtonClassProp: function () {
                if (this.options && this.options.numberButtonClass) {
                    return this.options.numberButtonClass;
                }
                return this.numberButtonClass;
            },
            numberClassProp: function () {
                if (this.options && this.options.numberClass) {
                    return this.options.numberClass;
                }
                return this.numberClass;
            },
            numbersCountForShowProp: function () {
                if (this.options && this.options.numbersCountForShow) {
                    return this.options.numbersCountForShow;
                }
                return this.numbersCountForShow;
            },
            activeClassProp: function () {
                if (this.options && this.options.activeClass) {
                    return this.options.activeClass;
                }
                return this.activeClass;
            }
        },
        watch: {
            data: {
                deep: true,
                handler() {
                    this.init();
                }
            },
        },
        data() {
            return {
                prevPageUrl: null,
                nextPageUrl: null,
                currentPage: 1,
                numbers: []
            }
        },
        methods: {
            init() {
                let current = this.data.hasOwnProperty('current_page') ? this.data.current_page : this.data.meta.current_page,
                    last = this.data.hasOwnProperty('last_page') ? this.data.last_page : this.data.meta.last_page,
                    delta = parseInt(this.numbersCountForShowProp),
                    left = current - delta,
                    right = current + delta + 1,
                    range = [],
                    rangeWithDots = [],
                    l;
                    
                for (let i = 1; i <= last; i++) {
                    if (i == 1 || i == last || i >= left && i < right) {
                        range.push(i);
                    }
                }
                for (let i of range) {
                    if (l) {
                        if (i - l === 2) {
                            rangeWithDots.push(l + 1);
                        } else if (i - l !== 1) {
                            rangeWithDots.push('...');
                        }
                    }
                    rangeWithDots.push(i);
                    l = i;
                }

                for (let i = 1; i <= last; i++) {
                    if ((i === 1 || i === last) || (i >= left && i < right)) {
                        range.push(i);
                    }
                }
                this.numbers = rangeWithDots;
                this.currentPage = this.data.hasOwnProperty('current_page') ? this.data.current_page : this.data.meta.current_page;
                this.nextPageUrl = this.data.hasOwnProperty('next_page_url') ? this.data.next_page_url : this.data.links.next;
                this.prevPageUrl = this.data.hasOwnProperty('prev_page_url') ? this.data.prev_page_url : this.data.links.prev;

                let summer = 0;
                
                if (current == 1) {
                    this.data.data.forEach( el => {
                        summer += el.amount;
                    });
                } else {
                    Object.entries(this.data.data).forEach(entry => {
                        const [key, value] = entry;
                        summer += value.amount;
                    });
                }

                this.$emit('summer', {summer: summer});
            },
            handler(page) {
                let parameters = {};
                if (this.requestParams) {
                    parameters = this.requestParams();
                }
                parameters.page = page;
                this.changePage(parameters);
            },
            isCurrent(page) {
                if (this.currentPage === page) {
                    return true;
                }
                return false;
            }
        },
        mounted() {
            // this.init();
        }
    }
</script>