check_cpu_usage
===============

This script is intended to be an icinga, nagios or naemon plugin which measures the CPU usage in percent. By default you get the total usage of all cores but you can also measure all the cores.

The php script is needed by pnp4nagios and is made for only one CPU. If you need more, extend the script to yur needs.

Usage
=====

First of all, dont run this script as root. It will create a temporary file called /tmp/check_cpu_usage.gap.tmp, whith the actual measures. The script comes with a help option.

'''
$ ./check_cpu_usage --help
check_cpu_usage 

This nagios plugin is free software, and comes with ABSOLUTELY NO WARRANTY. 
It may be used, redistributed and/or modified under the terms of the GNU 
General Public Licence (see http://www.fsf.org/licensing/licenses/gpl.txt).

Usage: check_cpu_usage < arguments > arguments: 
   [ -t|--timeout=<timeout> ]      timeout
   [ -c|--critical=<threshold> ]   critical threshold
   [ -w|--warning=<threshold> ]    warning threshold
   [ -s|--statfile=<file> ]        name of the stat file (default /proc/stat)
   [ -g|--gapfile=<file> ]         name of the gap file (default /tmp/check_cpu_usage.gap.tmp)
   [ -n|--names=<list> ]           comma separated list of names representing the column in the stats file
   [ -d|--details ]                show detailed information for each core

 -?, --usage
   Print usage information
 -h, --help
   Print detailed help screen
 -V, --version
   Print version information
 --extra-opts=[section][@file]
   Read options from an ini file. See http://nagiosplugins.org/extra-opts for usage
 --warning -c
   a list of threshold for warning in the same order as names
   (default none,none,none,none,none,none,none,none,none,none,none,none,none,none)
 --critical -c
   a list of threshold for critical in the same order as names
   (default none,none,none,none,none,none,none,none,none,none,none,none,none,none)
 --statfile -s
   name of the stat file (default /proc/stat)
 --gapfile -g
   name of the gap file (default /tmp/check_cpu_usage.gap.tmp)
 --details -d
   show detailed information for each core
 --names -n
   a comma separated list of names representing the column in the stats file. See 'man proc' for details
   (default user,nice,system,idle,iowait,irq,softirq,steal,guest,guest_nice,nyd1,nyd2,nyd3)
 -t, --timeout=INTEGER
   Seconds before plugin times out (default: 15)
 -v, --verbose
   Show details for command-line debugging (can repeat up to 3 times)
'''

