check_cpu_usage
===============

This script is intended to be an icinga, nagios or naemon plugin which measures the CPU usage in percent. By default you get the total usage of all cores but you can also measure all the cores.

The php script is needed by pnp4nagios and is made for only one CPU. If you need more, extend the script to your needs.

Usage
=====

First of all, don't run this script as root. It will create a temporary file called /tmp/check_cpu_usage.gap.tmp, with the actual measures. The script comes with a help option.

```
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
 --warning -w
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
```

Examples
========

Get the total usage of all CPU's.
```
/path/to/my/libexec/check_cpu_usage
```

Check the total usage of all CPU's and trigger the trespass of the defined thresholds on user, system and idle.
```
/path/to/my/libexec/check_cpu_usage -w 12,none,20,20:,none,none,none,none,none,none,none,none,none,none -c 24,none,40,10:,none,none,none,none,none,none,none,none,none,none -n user,nice,system,idle,iowait,irq,softirq,steal,guest,guest_nice,custom1,custom2,custom3
```

Example performance data image
![here] [cpu_usage]
[cpu_usage]: https://github.com/iamcheko/check_cpu_usage/tree/master/images/check_cpu_usage.png "example image"


