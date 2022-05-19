resource "aws_eip" "virginia" {
  vpc = true
}

resource "aws_nat_gateway" "virginia" {
  subnet_id = "subnet-0fe48a641e328bb56"
  allocation_id = aws_eip.virginia.allocation_id
}

resource "aws_eip" "california" {
  vpc = true
  provider = aws.us_west_1
}

resource "aws_nat_gateway" "california" {
  subnet_id = "subnet-07af25260e27a3dfd"
  allocation_id = aws_eip.california.allocation_id
  provider = aws.us_west_1
}
