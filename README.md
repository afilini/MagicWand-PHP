MagicWand-PHP
=============

MagicWand Tool for PHP

!Requires GD Library

USING:
call the function magicWand with the following parameter:
  magicWand(
  @param x int, the x coordinate of the starting pixel
  @param y int, the y coordinate of the starting pixel
  @param tollerance int, the toolerance of the tool. 0 = only same color, 1 = all colors
  @param imageHandle resource, the handle from imagecreatefrompng or any other GD creating instance
  @return bool, return true at the end of the function
  
