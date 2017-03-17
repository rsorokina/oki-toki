@extends('layout')

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" id="app">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->
            <div class="theme-panel hidden-xs hidden-sm">
                <div class="toggler"> </div>
                <div class="toggler-close"> </div>
                <div class="theme-options">
                    <div class="theme-option theme-colors clearfix">
                        <span> THEME COLOR </span>
                        <ul>
                            <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
                            <li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
                            <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                            <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
                            <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
                            <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
                        </ul>
                    </div>
                    <div class="theme-option">
                        <span> Theme Style </span>
                        <select class="layout-style-option form-control input-sm">
                            <option value="square" selected="selected">Square corners</option>
                            <option value="rounded">Rounded corners</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Layout </span>
                        <select class="layout-option form-control input-sm">
                            <option value="fluid" selected="selected">Fluid</option>
                            <option value="boxed">Boxed</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Header </span>
                        <select class="page-header-option form-control input-sm">
                            <option value="fixed" selected="selected">Fixed</option>
                            <option value="default">Default</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Top Menu Dropdown</span>
                        <select class="page-header-top-dropdown-style-option form-control input-sm">
                            <option value="light" selected="selected">Light</option>
                            <option value="dark">Dark</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Sidebar Mode</span>
                        <select class="sidebar-option form-control input-sm">
                            <option value="fixed">Fixed</option>
                            <option value="default" selected="selected">Default</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Sidebar Menu </span>
                        <select class="sidebar-menu-option form-control input-sm">
                            <option value="accordion" selected="selected">Accordion</option>
                            <option value="hover">Hover</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Sidebar Style </span>
                        <select class="sidebar-style-option form-control input-sm">
                            <option value="default" selected="selected">Default</option>
                            <option value="light">Light</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Sidebar Position </span>
                        <select class="sidebar-pos-option form-control input-sm">
                            <option value="left" selected="selected">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="theme-option">
                        <span> Footer </span>
                        <select class="page-footer-option form-control input-sm">
                            <option value="fixed">Fixed</option>
                            <option value="default" selected="selected">Default</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- END THEME PANEL -->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Portlets</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="#">
                                    <i class="icon-bell"></i> Action</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-shield"></i> Another action</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-user"></i> Something else here</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="#">
                                    <i class="icon-bag"></i> Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title pull-left"> Boxed Bootstrap Portlets &nbsp; &nbsp;</h1>
            <p>
                <button class="btn btn-default btn-outline btn-sm red"  v-on:click="addRow()">
                    <span class="panel-title">Add Panel &nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-plus" ></span>
                </button>
            </p>
            <!-- END PAGE TITLE-->

            <div class="modal" id="widgetModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="background-color:rgba(255,255,255,0.8)">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Select widget</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div :class="'col-md-' + widget.size" v-for="widget in widgets">
                                        <div v-on:click="addWidget(widget)" style="cursor: pointer">
                                            <widget-component v-bind:class="widget.class" v-bind:title="widget.title" v-bind:content="widget.content"></widget-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
            </div>







            <div id="sort">
                    <div class="portlet box grey-cascade sortable-item ui-state-default clearfix" v-for="(row, index) in rows">
                        <div class="portlet-title">
                            <div class="caption row-title">
                                <a href="avascript:;" v-text="row.title" style="color: #fff; border-bottom: dashed 1px #fff"></a>
                            </div>
                            <div class="actions">
                                <a href="javascript:;" class="btn btn-default btn-sm grey-cascade" v-on:click="setRowIndex(index)" data-toggle="modal" data-target="#widgetModal">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                                <a href="javascript:;" class="btn btn-default btn-sm grey-cascade" v-on:click="copyRow(index)">
                                    <span class="glyphicon glyphicon-copy"></span>
                                </a>
                                <a href="javascript:;" class="btn btn-default btn-sm grey-cascade" v-on:click="removeRow(index)">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                                <a href="javascript:;" class="btn btn-default btn-sm grey-cascade" v-on:click="row.show = !row.show" v-if="!row.show">
                                    <span class="glyphicon glyphicon-menu-up"></span>
                                </a>
                                <a href="javascript:;" class="btn btn-default btn-sm grey-cascade" v-on:click="row.show = !row.show" v-if="row.show">
                                    <span class="glyphicon glyphicon-menu-down"></span>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body sortrow clearfix" v-if="row.show">
                            <div class="sortable-item ui-state-default" :class="'col-md-' + item.size" v-for="(item, k) in row.items" >
                                <div class="portlet box" :class="item.class">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>
                                            <a href="avascript:;" v-text="item.title" style="color: #fff; border-bottom: dashed 1px #fff"></a>
                                        </div>
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a href="javascript:;" class="btn btn-default btn-sm" :class="item.class" v-on:click="resizeMore(item)">
                                                    <span class="glyphicon glyphicon-resize-horizontal"></span>
                                                </a>
                                                <a href="javascript:;" class="btn btn-default btn-sm" :class="item.class" v-on:click="resizeSmall(item)">
                                                    <span class="glyphicon glyphicon-resize-small"></span>
                                                </a>
                                                <a href="javascript:;" class="btn btn-default btn-sm" :class="item.class" v-on:click="removeWidget(index, k)">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="scroller" style="height:200px"  v-html="item.content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop


