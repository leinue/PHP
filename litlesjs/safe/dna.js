var quesArry = new Array();
function DNAQuestion() {
	this.KeyOuterSplit = "&";
	this.KeyInnerSplit = "@";
	this.defaultDNAQuesText = "请选择密保问题";
	this.defaultDNAQuesValue = "-1";
	this.keyString = new String();
	this.ddlArray = new Array();
	this.setKeyString = function(A) {
		this.keyString = A
	};
	this.changeSelectItem = function() {
		var E;
		var I = new Array();
		var J = this.getKeys();
		if (null == J) {
			return false
		}
		for (E = 0; E < this.ddlArray.length; E++) {
			I[E] = this.ddlArray[E].value
		}
		for (E = 0; E < this.ddlArray.length; E++) {
			var B = this.ddlArray[E];
			B.length = 0;
			B.options.add(new Option(this.defaultDNAQuesText, this.defaultDNAQuesValue));
			for (var D = 0; D < J.length; D++) {
				var G = J[D].split(this.KeyInnerSplit);
				var H = G[0];
				var F = G[1];
				var A = true;
				for (var C = 0; C < I.length; C++) {
					if (F == I[C] && F != I[E]) {
						A = false
					}
				}
				if (A) {
					B.options.add(new Option(H, F))
				}
			}
			setDDLValueByCtrl(B, I[E], false)
		}
		return true
	};
	this.addDNAQuesDDL = function(A) {
		var C = document.getElementById(A);
		if (null == C) {
			return false
		}
		var B;
		for (B = 0; B < this.ddlArray.length; B++) {
			if (C == this.ddlArray[B]) {
				break
			}
		}
		if (B >= this.ddlArray.length) {
			this.ddlArray.push(C);
			return true
		} else {
			return false
		}
		return true
	};
	this.removeAllDNAQuesDDL = function() {
		this.ddlArray.length = 0
	};
	this.getKeys = function() {
		if (this.keyString != null) {
			var A = this.keyString.split(this.KeyOuterSplit);
			return A
		}
		return null
	};
	this.initAllDNAQuestionDDL = function() {
		var I = this.getKeys();
		if (null == I) {
			return false
		}
		for (var D = 0; D < this.ddlArray.length; D++) {
			var A = this.ddlArray[D];
			A.length = 0;
			A.options.add(new Option(this.defaultDNAQuesText, this.defaultDNAQuesValue));
			for (var C = 0; C < I.length; C++) {
				var G = I[C].split(this.KeyInnerSplit);
				var H = G[0];
				var F = G[1];
				var E = true;
				for (var B = 0; B < quesArry.length; B++) {
					if (F == quesArry[B] && D != B) {
						E = false;
						break
					}
				}
				if (E) {
					A.options.add(new Option(H, F))
				}
				if (quesArry.length != 0 && quesArry[D] == F) {
					A.value = F
				}
			}
		}
		return true
	}
}
function DNAKeyObj(A, C, B) {
	this.keyTxt = A;
	this.keyID = C;
	this.keyType = B
}
function DNACtrlPair(B, A) {
	this.ddlCtrl = B;
	this.inputCtrl = A
}
function DNAAnswerVerifySetDNA() {
	this.KeyOuterSplit = "&";
	this.KeyInnerSplit = "@";
	this.keyString = new String();
	this.arrKeys = new Array();
	this.ctrlPair = new Array();
	this.getKeys = function() {
		if (this.keyString != null) {
			var A = this.keyString.split(this.KeyOuterSplit);
			return A
		}
		return null
	};
	this.setKeyString = function(A) {
		this.keyString = A;
		var D = this.getKeys();
		if (null == D) {
			return false
		}
		this.arrKeys.length = 0;
		for (var B = 0; B < D.length; B++) {
			var C = D[B].split(this.KeyInnerSplit);
			var E = new DNAKeyObj(C[0], C[1], C[2]);
			this.arrKeys.push(E)
		}
		return true
	};
	this.addCtrlPairByCtrlID = function(A, B) {
		this.addCtrlPair(document.getElementById(A), document.getElementById(B))
	};
	this.addCtrlPair = function(C, B) {
		var A = new DNACtrlPair(C, B);
		this.ctrlPair.push(A)
	};
	this.removeAllCtrlPair = function() {
		this.ctrlPair.length = 0
	};
	this.getKeyTypeByKeyID = function(D) {
		var A = -1;
		var C;
		for (C = 0; C < this.arrKeys.length; C++) {
			var B = this.arrKeys[C];
			if (D == B.keyID) {
				A = B.keyType;
				break
			}
		}
		return A
	};
	this.verifyDNAByStr = function(E, D) {
		if (null == E || null == D) {
			return - 1
		}
		var A = -1;
		var C;
		for (C = 0; C < this.arrKeys.length; C++) {
			var B = this.arrKeys[C];
			if (E == B.keyID) {
				A = B.keyType
			}
		}
		if ( - 1 == A) {
			return - 1
		}
		return DNAChecker(A, D)
	};
	this.getInputCtrlByQuesDDLCtrl = function(D) {
		if (null == D) {
			return null
		}
		var B;
		var C = null;
		for (B = 0; B < this.ctrlPair.length; B++) {
			var A = this.ctrlPair[B];
			if (A.ddlCtrl == D) {
				C = A.inputCtrl;
				break
			}
		}
		return C
	};
	this.getDDLCtrlByAnswerCtrl = function(D) {
		if (null == D) {
			return null
		}
		var C;
		var A = null;
		for (C = 0; C < this.ctrlPair.length; C++) {
			var B = this.ctrlPair[C];
			if (B.inputCtrl == D) {
				A = B.ddlCtrl;
				break
			}
		}
		return A
	};
	this.verifyDNAByQuesDDLCtrl = function(D) {
		if (null == D) {
			return - 1
		}
		var B;
		var C = null;
		for (B = 0; B < this.ctrlPair.length; B++) {
			var A = this.ctrlPair[B];
			if (A.ddlCtrl == D) {
				C = A.inputCtrl;
				break
			}
		}
		if (C != null) {
			return this.verifyDNAByStr(D.value, C.value)
		} else {
			return - 1
		}
	};
	this.verifyDNAByAnswerCtrl = function(D) {
		if (null == D) {
			return - 1
		}
		var C;
		var B = null;
		for (C = 0; C < this.ctrlPair.length; C++) {
			var A = this.ctrlPair[C];
			if (A.inputCtrl == D) {
				B = A.ddlCtrl;
				break
			}
		}
		if (B != null) {
			return this.verifyDNAByStr(B.value, D.value)
		} else {
			return - 1
		}
	}
}
function DNAChecker(A, C) {
	var B = function(F) {
		var E = /^[ ]{1,}|^[　]{1,}|[ ]{1,}$|[　]{1,}$/;
		var D = 0;
		if (E.test(F)) {
			D = 1
		}
		return D
	};
	this.checkNumber = function(F) {
		if (B(F)) {
			return 2
		}
		var E = /^\d{2,16}$/;
		var D = 3;
		if (E.test(F)) {
			D = 1
		}
		return D
	};
	this.checkName = function(G) {
		var H = new Array("妈妈", "爸爸");
		if (B(G)) {
			return 2
		}
		if (/^[\u4e00-\u9fa5]{1,}[　 ]/.test(G)) {
			return 5
		}
		var F = /^([\u4e00-\u9fa5]{2,19}|[A-Za-z ]{3,38})$/;
		var D = 3;
		if (F.test(G)) {
			for (var E = 0; E < H.length; E++) {
				if (G == H[E]) {
					return 6
				}
			}
			D = 1
		}
		return D
	};
	this.checkDate = function(H) {
		if (B(H)) {
			return 2
		}
		var D = 3;
		var G = H.match(/^(\d{4})(\d{2})(\d{2})$/);
		if (G != null) {
			var F = parseInt(G[1]);
			var I = new Number(G[2]);
			var E = new Number(G[3]);
			if (F > 1900 && F < 2100 && I > 0 && I < 13 && E > 0 && E < 32) {
				D = 1
			}
		}
		return D
	};
	this.checkAnswer = function(E, F) {
		if (null == F) {
			return - 1
		}
		if (F == "") {
			return 4
		}
		var D = -1;
		switch (E.toString()) {
		case "0":
			D = this.checkNumber(F);
			break;
		case "1":
			D = this.checkName(F);
			break;
		case "2":
			D = this.checkDate(F);
			break;
		default:
			break
		}
		return D
	};
	return this.checkAnswer(A, C)
}
function DNATipPair(A, B) {
	this.answerCtrl = A;
	this.tipCtrl = B
}
function DnaTips() {
	this.arrTips = new Array();
	this.arrTips[0] = "请填写2至16个阿拉伯数字";
	this.arrTips[1] = "请填写2-19个中文或3-38个英文";
	this.arrTips[2] = "请填写日期，例如20080619";
	this.arrTips[ - 1] = "请先选择机密问题，并请慎重填写和牢记表示";
	this.ansTipPair = new Array();
	this.addAnsTipPair = function(C, B) {
		var A = new DNATipPair(C, B);
		this.ansTipPair.push(A)
	};
	this.getTipCtrlByAnsCtrl = function(D) {
		var B;
		var C = null;
		for (B = 0; B < this.ansTipPair.length; B++) {
			var A = this.ansTipPair[B];
			if (A.answerCtrl == D) {
				C = A.tipCtrl;
				break
			}
		}
		return C
	};
	this.setDnaTip = function(B, A, D, E) {
		var C = parseInt(E);
		var F = this.getTipCtrlByAnsCtrl(B);
		if (C == -1) {
			F.className = D;
			F.style.display = "";
			F.innerHTML = "请正确选择问题";
			return
		}
		switch (A) {
		case 1:
			F.className = "";
			F.style.display = "none";
			F.innerHTML = "";
			break;
		case - 1 : break;
		case 2:
			F.className = D;
			F.style.display = "";
			F.innerHTML = "答案首尾不能含有空格";
			break;
		case 3:
		case 4:
			F.className = D;
			F.style.display = "";
			F.innerHTML = this.arrTips[C];
			break;
		case 5:
			F.className = D;
			F.style.display = "";
			F.innerHTML = "中文答案里不能含有空格";
			break;
		case 6:
			F.className = D;
			F.style.display = "";
			F.innerHTML = "您输入的答案过于简单";
			break;
		default:
			break
		}
	};
	this.clearDnaTip = function(A) {
		var B = document.getElementById(A);
		B.innerHTML = ""
	}
}
function DnaSetHandler(A) {
	if (typeof(A) != "undefined" && A == "1") {
		this.strDnaQues = "您母亲的姓名是？@4@1&您父亲的姓名是？@1@1&您最熟悉的童年好友名字是？@16@1"
	} else {
		this.strDnaQues = "您母亲的姓名是？@4@1&您父亲的职业是？@3@1&您配偶的生日是？@8@2&您的学号（或工号）是？@13@0&您母亲的生日是？@5@2&您高中班主任的名字是？@12@1&您父亲的姓名是？@1@1&您的出生地是？@14@1&您小学班主任的名字是？@10@1&您的小学校名是？@15@1&您父亲的生日是？@2@2&您配偶的姓名是？@7@1&您母亲的职业是？@6@1&您初中班主任的名字是？@11@1&您配偶的职业是？@9@1&您最熟悉的童年好友名字是？@16@1&您最熟悉的学校宿舍室友名字是？@17@1&对您影响最大的人名字是？@18@1"
	}
	this.dnaObj = null;
	this.dnaVerifyObj = null;
	this.dnaTipsObj = null;
	this.initDNADDL = function() {
		this.dnaObj = new DNAQuestion();
		this.dnaObj.setKeyString(this.strDnaQues);
		this.dnaObj.addDNAQuesDDL("ddlDNAQues1");
		this.dnaObj.addDNAQuesDDL("ddlDNAQues2");
		this.dnaObj.addDNAQuesDDL("ddlDNAQues3");
		this.dnaObj.initAllDNAQuestionDDL()
	};
	this.initDNAVerifyObj = function() {
		this.dnaVerifyObj = new DNAAnswerVerifySetDNA();
		this.dnaVerifyObj.setKeyString(this.strDnaQues);
		this.dnaVerifyObj.addCtrlPairByCtrlID("ddlDNAQues1", "txtAnswer1");
		this.dnaVerifyObj.addCtrlPairByCtrlID("ddlDNAQues2", "txtAnswer2");
		this.dnaVerifyObj.addCtrlPairByCtrlID("ddlDNAQues3", "txtAnswer3")
	};
	this.initDnaTipsObj = function() {
		this.dnaTipsObj = new DnaTips();
		this.dnaTipsObj.addAnsTipPair(document.getElementById("txtAnswer1"), document.getElementById("divDnaTip1"));
		this.dnaTipsObj.addAnsTipPair(document.getElementById("txtAnswer2"), document.getElementById("divDnaTip2"));
		this.dnaTipsObj.addAnsTipPair(document.getElementById("txtAnswer3"), document.getElementById("divDnaTip3"))
	};
	this.getDNAObj = function() {
		return this.dnaObj
	};
	this.getDNAVerifyObj = function() {
		return this.dnaVerifyObj
	};
	this.selectionChange = function(C) {
		this.dnaObj.changeSelectItem();
		var B = this.dnaVerifyObj.verifyDNAByQuesDDLCtrl(C);
		var D = this.dnaVerifyObj.getInputCtrlByQuesDDLCtrl(C);
		var E = this.dnaVerifyObj.getKeyTypeByKeyID(C.value);
		this.dnaTipsObj.setDnaTip(D, B, "import", E)
	};
	this.checkTitle = function(C, B, J) {
		if ("0" == B.toString() || "2" == B.toString()) {
			return 1
		}
		var F = J.length;
		var H = "";
		var I = this.dnaVerifyObj.getKeys();
		for (var D = 0; D < I.length; D++) {
			var G = I[D].split(this.dnaVerifyObj.KeyInnerSplit);
			if (G[1] == C && B == G[2]) {
				H = G[0]
			}
		}
		if (H.length < F) {
			return 1
		}
		for (var E = 0; E <= (H.length - F); E++) {
			if (J == H.substr(E, F)) {
				return 6
			}
		}
		return 1
	};
	this.answerBlur = function(D) {
		var C = this.dnaVerifyObj.verifyDNAByAnswerCtrl(D);
		var B = this.dnaVerifyObj.getDDLCtrlByAnswerCtrl(D);
		var E = this.dnaVerifyObj.getKeyTypeByKeyID(B.value);
		if (1 == C) {
			C = this.checkTitle(B.value, E, D.value)
		}
		this.dnaTipsObj.setDnaTip(D, C, "info", E);
		return C
	};
	this.checkAll = function() {
		var F = true;
		for (var C = 0; C < this.dnaVerifyObj.ctrlPair.length; C++) {
			var D = this.dnaVerifyObj.ctrlPair[C];
			var B = this.dnaVerifyObj.verifyDNAByAnswerCtrl(D.inputCtrl);
			var E = this.dnaVerifyObj.getKeyTypeByKeyID(D.ddlCtrl.value);
			if (1 == B) {
				B = this.checkTitle(D.ddlCtrl.value, E, D.inputCtrl.value)
			}
			this.dnaTipsObj.setDnaTip(D.inputCtrl, B, "info", E);
			if (B != 1) {
				F = false
			}
		}
		return F
	};
	this.initDNADDL();
	this.initDNAVerifyObj();
	this.initDnaTipsObj()
}
function DnaTypeAnsPair(A, B) {
	this.quesType = A;
	this.ansCtrl = B
}
function DnaCheckHandler(A) {
	if (typeof(A) != "undefined" && A == "1") {
		this.strDnaQues = "您母亲的姓名是？@4@1&您父亲的姓名是？@1@1&您最熟悉的童年好友名字是？@16@1"
	} else {
		this.strDnaQues = "您母亲的姓名是？@4@1&您父亲的职业是？@3@1&您配偶的生日是？@8@2&您的学号（或工号）是？@13@0&您母亲的生日是？@5@2&您高中班主任的名字是？@12@1&您父亲的姓名是？@1@1&您的出生地是？@14@1&您小学班主任的名字是？@10@1&您的小学校名是？@15@1&您父亲的生日是？@2@2&您配偶的姓名是？@7@1&您母亲的职业是？@6@1&您初中班主任的名字是？@11@1&您配偶的职业是？@9@1&您最熟悉的童年好友名字是？@16@1&您最熟悉的学校宿舍室友名字是？@17@1&对您影响最大的人名字是？@18@1"
	}
	this.dnaTipsObj = null;
	this.dnaTypeAnsPairs = new Array();
	this.init = function() {
		this.dnaObj = new DNAQuestion();
		this.dnaTipsObj = new DnaTips();
		if (quesNum > 0) {
			this.dnaTipsObj.addAnsTipPair(document.getElementById("dnaAnswer1"), document.getElementById("divDnaAnsTip1"));
			var D = new DnaTypeAnsPair(quesType1, document.getElementById("dnaAnswer1"));
			this.dnaTypeAnsPairs.push(D)
		}
		if (quesNum > 1) {
			this.dnaTipsObj.addAnsTipPair(document.getElementById("dnaAnswer2"), document.getElementById("divDnaAnsTip2"));
			var C = new DnaTypeAnsPair(quesType2, document.getElementById("dnaAnswer2"));
			this.dnaTypeAnsPairs.push(C)
		}
		if (quesNum > 2) {
			this.dnaTipsObj.addAnsTipPair(document.getElementById("dnaAnswer3"), document.getElementById("divDnaAnsTip3"));
			var B = new DnaTypeAnsPair(quesType3, document.getElementById("dnaAnswer3"));
			this.dnaTypeAnsPairs.push(B)
		}
	};
	this.getQuesTypeByAnsCtrl = function(E) {
		var B = null;
		for (var D = 0; D < this.dnaTypeAnsPairs.length; D++) {
			var C = this.dnaTypeAnsPairs[D];
			if (C.ansCtrl == E) {
				B = C.quesType;
				break
			}
		}
		return B
	};
	this.check = function(C) {
		var D = this.getQuesTypeByAnsCtrl(C);
		var B = DNAChecker(D, C.value);
		this.dnaTipsObj.setDnaTip(C, B, "info", D);
		return B
	};
	this.checkAll = function() {
		var E = true;
		for (var C = 0; C < this.dnaTypeAnsPairs.length; C++) {
			var D = this.dnaTypeAnsPairs[C];
			var B = DNAChecker(D.quesType, D.ansCtrl.value);
			this.dnaTipsObj.setDnaTip(D.ansCtrl, B, "info", D.quesType);
			if (B != 1) {
				E = false
			}
		}
		return E
	};
	this.init()
}
function DnaAnser3Handler(B, A, F, E, D, C) {
	this.arrTips = new Array();
	this.arrTips[0] = "密保问题的答案不允许相同";
	this.check = function() {
		this.txtCtrl1 = document.getElementById(B);
		this.divTipCtrl1 = document.getElementById(A);
		this.txtCtrl2 = document.getElementById(F);
		this.divTipCtrl2 = document.getElementById(E);
		this.txtCtrl3 = document.getElementById(D);
		this.divTipCtrl3 = document.getElementById(C);
		var G = compareString(this.txtCtrl1.value, this.txtCtrl2.value, this.txtCtrl3.value);
		this.divTipCtrl1.style.display = "";
		this.divTipCtrl2.style.display = "";
		this.divTipCtrl3.style.display = "";
		switch (G) {
		case 123:
			this.divTipCtrl1.className = "info";
			this.divTipCtrl1.innerHTML = this.arrTips[0];
			this.divTipCtrl2.className = "info";
			this.divTipCtrl2.innerHTML = this.arrTips[0];
			this.divTipCtrl3.className = "info";
			this.divTipCtrl3.innerHTML = this.arrTips[0];
			break;
		case 12:
			this.divTipCtrl1.className = "info";
			this.divTipCtrl1.innerHTML = this.arrTips[0];
			this.divTipCtrl2.className = "info";
			this.divTipCtrl2.innerHTML = this.arrTips[0];
			this.divTipCtrl3.className = "";
			this.divTipCtrl3.innerHTML = "";
			break;
		case 23:
			this.divTipCtrl1.className = "";
			this.divTipCtrl1.innerHTML = "";
			this.divTipCtrl2.className = "info";
			this.divTipCtrl2.innerHTML = this.arrTips[0];
			this.divTipCtrl3.className = "info";
			this.divTipCtrl3.innerHTML = this.arrTips[0];
			break;
		case 13:
			this.divTipCtrl1.className = "info";
			this.divTipCtrl1.innerHTML = this.arrTips[0];
			this.divTipCtrl2.className = "";
			this.divTipCtrl2.innerHTML = "";
			this.divTipCtrl3.className = "info";
			this.divTipCtrl3.innerHTML = this.arrTips[0];
			break;
		case 0:
			this.divTipCtrl1.className = "";
			this.divTipCtrl1.innerHTML = "";
			this.divTipCtrl2.className = "";
			this.divTipCtrl2.innerHTML = "";
			this.divTipCtrl3.className = "";
			this.divTipCtrl3.innerHTML = "";
		default:
			break
		}
		return (G == 0)
	};
	this.showHint = function() {
		this.divTipCtrl.className = "import";
		this.divTipCtrl.innerHTML = this.hintTip
	}
}
function compareString(C, B, A) {
	if (C == B && C == A) {
		return 123
	}
	if (C == B) {
		return 12
	}
	if (C == A) {
		return 13
	}
	if (B == A) {
		return 23
	}
	return 0
};