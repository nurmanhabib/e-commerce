<style>
	
</style>

<template>
	<slot></slot>
	<ul class="navigation navigation-main navigation-accordion">
        <li class="navigation-header"><span>Dashboard</span> <i class="icon-menu" title="Main pages"></i></li>

        <li v-for="item in items">
        	<a href="{{ item.link }}">
        		<span>{{ item.text }}</span> <i class="{{ item.icon }}" title="{{ item.text }}"></i>
        	</a>
        	<ul v-if="item.childs">
        		<li v-for="child in item.childs">
        			<a href="{{ url('child.link') }}">
        				<span>{{ child.text }}</span> <i class="{{ child.icon }}" title="{{ child.text }}"></i>
        			</a>
        		</li>
        	</ul>
        </li>

        <!-- Main -->
        <!-- <li class="active"><a href="{{ url('/') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li> -->
        <!-- /main -->

        <!-- Forms -->
        <!-- <li>
            <a href="#"><i class="icon-pencil3"></i> <span>Category</span></a>
            <ul>
                <li><a href="form_inputs_basic.html">Basic inputs</a></li>
                <li><a href="form_checkboxes_radios.html">Checkboxes &amp; radios</a></li>
                <li><a href="form_input_groups.html">Input groups</a></li>
                <li><a href="form_controls_extended.html">Extended controls</a></li>
                <li>
                    <a href="#">Selects</a>
                    <ul>
                        <li><a href="form_select2.html">Select2 selects</a></li>
                        <li><a href="form_multiselect.html">Bootstrap multiselect</a></li>
                        <li><a href="form_select_box_it.html">SelectBoxIt selects</a></li>
                        <li><a href="form_bootstrap_select.html">Bootstrap selects</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icon-footprint"></i> <span>Supplier</span></a>
            <ul>
                <li><a href="wizard_steps.html">Barang</a></li>
                <li><a href="wizard_form.html">Order</a></li>
            </ul>
        </li> -->
        <!-- /forms -->
    </ul>
</template>

<script lang="es6">
	module.exports = {
		props: {
			active: null
		},

		data() {
			return {
				items: [
					{
						'text'	: 'Dashboard',
						'link' 	: '/admin',
						'icon' 	: 'icon-home4',
						'active': false,
					},
					{
						'text'	: 'Category',
						'link' 	: 'category',
						'icon' 	: 'icon-pencil3',
						'active': false,
					},
					{
						'text'	: 'Supplier',
						'link'	: 'supplier',
						'icon' 	: 'icon-users',
						'active': false,
					}
				],
				active: ''
			}
		},
		methods: {

		},
		ready() {
			console.log(this.items)
		}
	}
</script>