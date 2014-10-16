
<?php
#-------------------------------------------------------------------------------
#
#   Configuration   : check_cpu_usage
#
#-------------------------------------------------------------------------------
#
#   Description     : PNP Graph Template for check_cpu_usage
#
#   Author          : Marek Zavesicky
#   Version         : $Revision: $
#   Erstellt        : 2013/02/06
#   Letztes Update  : $Date: $
#
#   $Id: $
#   Change history  :
#                     $Log: $
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
#   General settings
#-------------------------------------------------------------------------------
#   Arrays start with 0 while DS starts with 1. Fill index 0 with some garbage.
$A_COLORS = array(
    '#000',
    '#FF3633', '#FF7E05', '#FAE100', '#00E613', '#0AFFFB', '#00AEFF',
    '#004CFF', '#2205FF', '#6F0FFF', '#B30FFF', '#E70FFF', '#FF00AA', 
    '#B43C3C', '#BB573E', '#C3894B', '#BBB33E', '#77BF40', '#40BF79',
);

$L_COLORS = array(
    '#000', '#316BBB',
    '#71B905', '#CC3118', '#CC7016', '#C9B215', '#1598C3', '#B415C7', '#4D18E4',
    '#000', '#000', '#000', '#000', '#000', '#000'
);

#   Fill in some usefull lables
$LABELS = array(
    '', 'All CPU User', 'All CPU Nice', 'All CPU System', 'All CPU Idle',
    'All CPU IO Wait', 'All CPU IRQ', 'All CPU Soft IRQ', 'All CPU Steal',
    'All CPU Guest', 'All CPU Guest Nice', '', '', ''
);

#
#   Settings
#-------------------------------------------------------------------------------
# Length of the string in legend
$slen = 20;
# Set Labels of the graphs
$ds_name[1] = "All CPU Usage Detail";

#
#   Initialize graphs
#-------------------------------------------------------------------------------
$opt[1] = "";
$def[1] = "";

#
#   Label and Titel settings
#-------------------------------------------------------------------------------
$opt[1] .= "--vertical-label \"%\" ";
$opt[1] .= "--title \"$ds_name[1] of $hostname\" ";
$opt[1] .= "--lower=0 ";

#
#   Body definition graph
#-------------------------------------------------------------------------------
foreach ( $DS as $I )
{
    if ( preg_match( '/.*nyd.*/', $NAME[$I] ) )
    {
        continue;
    }
    if ( $I == 1 )
    {
        $def[1] .= rrd::def( "var$I", $rrdfile, $DS[$I], 'AVERAGE' );
        $def[1] .= rrd::area( "var$I", $A_COLORS[$I], rrd::cut( $LABELS[$I], $slen ) );
        $def[1] .= rrd::gprint("var$I", array("AVERAGE", "MAX", "LAST"), "%8.2lf%s");
    }
    else
    {
        $def[1] .= rrd::def( "var$I", $rrdfile, $DS[$I], 'AVERAGE' );
        $def[1] .= rrd::area( "var$I", $A_COLORS[$I], rrd::cut( $LABELS[$I], $slen ), 'STACK' );
        $def[1] .= rrd::gprint("var$I", array("AVERAGE", "MAX", "LAST"), "%8.2lf%s");
    }
    if ( "$WARN[$I]" != "")
    {
        $def[1] .= rrd::hrule($WARN[$I], "#FFFF00", "Warning  $WARN[$I]$UNIT[$I]\\t");
    }
    if ( "$CRIT[$I]" != "")
    {
        $def[1] .= rrd::hrule($CRIT[$I], "#FF0000", "Critical  $CRIT[$I]$UNIT[$I]\\n");
    }
}

?>
